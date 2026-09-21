<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function blog2(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');

        $query = DB::table('blogs')->orderBy('id', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blog2 = $query->paginate($perPage)->withQueryString();

        $totalArticles = DB::table('blogs')->count();
        $publishedArticles = DB::table('blogs')->where('status', 1)->count();
        $hiddenArticles = $totalArticles - $publishedArticles;

        if ($request->ajax()) {
            return response()->json([
                'table_html' => view('admin.partials.table', compact('blog2', 'search'))->render(),
                'total_articles' => $totalArticles,
                'published_articles' => $publishedArticles,
                'hidden_articles' => $hiddenArticles,
                'page' => $blog2->currentPage(),
                'last_page' => $blog2->lastPage(),
            ]);
        }

        return view('admin.dashboard', compact('blog2', 'totalArticles', 'publishedArticles', 'hiddenArticles', 'search', 'perPage'));
    }
    function about2()
    {
        $about2 = [
            'name' => 'jiraphol',
            'nickname' => 'Hom',
            'age' => 21,
            'birthday' => '14/11/2004'
        ];
        return view('admin.about', compact('about2'));
    }
    function create()
    {
        return view('form');
    }

    function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'status' => 'required',
        ], [
            'title.required' => 'กรุณากรอกชื่อบทความ',
            'title.max' => 'ชื่อบทความต้องไม่เกิน 50 ตัวอักษร',
            'content.required' => 'กรุณากรอกเนื้อหาบทความ',
            'status.required' => 'กรุณากรอกสถานะ',
        ]);

        DB::table('blogs')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'สร้างบทความใหม่เรียบร้อยแล้ว!');
    }

    function edit($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        
        if (!$blog) {
            return redirect()->route('admin.dashboard')->with('error', 'ไม่พบบทความที่ต้องการแก้ไข');
        }

        return view('edit', compact('blog'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'status' => 'required',
        ], [
            'title.required' => 'กรุณากรอกชื่อบทความ',
            'title.max' => 'ชื่อบทความต้องไม่เกิน 50 ตัวอักษร',
            'content.required' => 'กรุณากรอกเนื้อหาบทความ',
            'status.required' => 'กรุณากรอกสถานะ',
        ]);

        DB::table('blogs')->where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'แก้ไขบทความเรียบร้อยแล้ว!');
    }

    function delete(Request $request, $id)
    {
        DB::table('blogs')->where('id', $id)->delete();

        if ($request->ajax()) {
            $totalArticles = DB::table('blogs')->count();
            $publishedArticles = DB::table('blogs')->where('status', 1)->count();
            $hiddenArticles = $totalArticles - $publishedArticles;

            return response()->json([
                'success' => true,
                'message' => 'ลบบทความเรียบร้อยแล้ว!',
                'total_articles' => $totalArticles,
                'published_articles' => $publishedArticles,
                'hidden_articles' => $hiddenArticles,
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'ลบบทความเรียบร้อยแล้ว!');
    }
}
