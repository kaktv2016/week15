<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiSanctumBlogTest extends TestCase
{
    public function test_register_creates_user_and_returns_token(): void
    {
        // Clean up user if exists
        User::where('email', 'john@example.com')->delete();

        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                'token',
            ]);
    }

    public function test_login_success_and_failure(): void
    {
        // Ensure user exists
        User::where('email', 'john@example.com')->delete();
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Test wrong password
        $failResponse = $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'wrongpass',
        ]);
        $failResponse->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
            ]);

        // Test valid password
        $successResponse = $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);
        $successResponse->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'user',
                'token',
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'เข้าสู่ระบบสำเร็จ',
            ]);
    }

    public function test_protected_routes_require_authentication(): void
    {
        $this->getJson('/api/user')->assertStatus(401);
        $this->postJson('/api/blogs', ['title' => 'Test', 'content' => 'Test'])->assertStatus(401);
        $this->postJson('/api/logout')->assertStatus(401);
    }

    public function test_protected_user_profile_and_logout(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'john@example.com'],
            ['name' => 'John Doe', 'password' => bcrypt('password123')]
        );

        $token = $user->createToken('testtoken')->plainTextToken;

        // Get user profile
        $userResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/user');
        $userResponse->assertStatus(200)
            ->assertJson(['email' => 'john@example.com']);

        // Logout
        $logoutResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/logout');
        $logoutResponse->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'ออกจากระบบเรียบร้อยแล้ว (Token ถูกยกเลิก)',
            ]);

        // After logout, reset guard cache and token should be invalid
        auth('sanctum')->forgetUser();
        $this->app['auth']->forgetGuards();
        $afterLogoutResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/user');
        $afterLogoutResponse->assertStatus(401);
    }

    public function test_crud_blogs_api(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'john@example.com'],
            ['name' => 'John Doe', 'password' => bcrypt('password123')]
        );
        $token = $user->createToken('blogcrudtoken')->plainTextToken;

        // 1. Create Blog (Protected)
        $createResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/blogs', [
                'title' => 'เรียนรู้ RESTful API กับ Laravel 11',
                'content' => 'เนื้อหาบทความใหม่สำหรับทดสอบบันทึกผ่าน API',
                'status' => true,
            ]);

        $createResponse->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'content',
                    'status',
                    'created_at',
                ],
            ])
            ->assertJson([
                'data' => [
                    'title' => 'เรียนรู้ RESTful API กับ Laravel 11',
                    'content' => 'เนื้อหาบทความใหม่สำหรับทดสอบบันทึกผ่าน API',
                    'status' => true,
                ],
            ]);

        $blogId = $createResponse->json('data.id');

        // 2. Get All Blogs (Public)
        $indexResponse = $this->getJson('/api/blogs');
        $indexResponse->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'links',
                'meta',
            ]);

        // 3. Get Single Blog (Public)
        $showResponse = $this->getJson('/api/blogs/' . $blogId);
        $showResponse->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $blogId,
                    'title' => 'เรียนรู้ RESTful API กับ Laravel 11',
                ],
            ]);

        // 4. Update Blog (Protected)
        $updateResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson('/api/blogs/' . $blogId, [
                'title' => 'เรียนรู้ RESTful API (แก้ไข)',
                'content' => 'เนื้อหาบทความที่อัปเดตแล้ว',
            ]);

        $updateResponse->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $blogId,
                    'title' => 'เรียนรู้ RESTful API (แก้ไข)',
                    'content' => 'เนื้อหาบทความที่อัปเดตแล้ว',
                ],
            ]);

        // 5. Delete Blog (Protected)
        $deleteResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->deleteJson('/api/blogs/' . $blogId);

        $deleteResponse->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'ลบบทความเรียบร้อยแล้ว',
            ]);

        // 6. Verify Blog deleted
        $notFoundResponse = $this->getJson('/api/blogs/' . $blogId);
        $notFoundResponse->assertStatus(404);
    }
}
