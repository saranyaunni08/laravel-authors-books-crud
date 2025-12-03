<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class AuthorController extends Controller
{
    // index() - GET /api/authors
    public function index()
    {
        $authors = Author::with('books')->get();
        return response()->json($authors);
    }

    // store() - POST /api/authors
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
            'books' => 'required|array|min:1',
            'books.*.name' => 'required|string',
            'books.*.price' => 'required|numeric|min:0.01',
        ]);

        $author = Author::create($request->only('name', 'email'));
        foreach ($request->books as $book) {
            $author->books()->create($book);
        }

        return response()->json(Author::with('books')->find($author->id), 201);
    }

    // show() - GET /api/authors/{id}
    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return response()->json($author);
    }

    // update() - PUT /api/authors/{id}
    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:authors,email,' . $id,
            'books' => 'required|array|min:1',
            'books.*.id' => 'sometimes|exists:books,id',
            'books.*.name' => 'required|string',
            'books.*.price' => 'required|numeric|min:0.01',
        ]);

        $author->update($request->only('name', 'email'));

        // Sync books (delete old ones not in list, update or create)
        $existingIds = [];
        foreach ($request->books as $bookData) {
            if (isset($bookData['id'])) {
                Book::where('id', $bookData['id'])
                    ->where('author_id', $author->id)
                    ->update(['name' => $bookData['name'], 'price' => $bookData['price']]);
                $existingIds[] = $bookData['id'];
            } else {
                $newBook = $author->books()->create($bookData);
                $existingIds[] = $newBook->id;
            }
        }
        // Delete removed books
        $author->books()->whereNotIn('id', $existingIds)->delete();

        return response()->json(Author::with('books')->find($id));
    }

    // destroy() - DELETE /api/authors/{id}
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete(); // books auto-deLETED because of onDelete('cascade')
        return response()->json(null, 204);
    }
}
