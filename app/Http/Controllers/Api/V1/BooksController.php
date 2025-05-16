<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $books = \App\Models\Book::all();

        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): BookResource
    {
        $path = $request->file('image')->store('images', 'public');

        $book = Book::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author' => $request->input('author'),
            'price' => $request->input('price'),
            'image_path' => $path,
        ]);

        return BookResource::make($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): BookResource
    {
        return BookResource::make($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): BookResource
    {
        $updateData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author' => $request->input('author'),
            'price' => $request->input('price'),
        ];

       if ($request->hasFile('image')) {
           $fileName = $book->id . '_' . $request->file('image')->getClientOriginalName();
           $updateData['image_path'] = $request->file('image')->storeAs('images', $fileName, 'public');
       }

        $book->update($updateData);

        return BookResource::make($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): BookResource
    {
        $book->delete();

        return BookResource::make($book);
    }
}
