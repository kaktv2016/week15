<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // จำลองข้อมูลหนังสือ
        $books = [
            [
                'id' => 1,
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'price' => 450,
                'status' => true,
            ],
            [
                'id' => 2,
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'price' => 380,
                'status' => true,
            ],
            [
                'id' => 3,
                'title' => '1984',
                'author' => 'George Orwell',
                'price' => 520,
                'status' => false, // Out of stock
            ]
        ];

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }
}
