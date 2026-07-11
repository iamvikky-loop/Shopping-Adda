<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    private const UPLOAD_PATH = 'uploads/categories';

    private const SORTABLE_COLUMNS = [
        'name',
        'slug',
        'status',
        'created_at',
    ];

    /**
     * Display a listing of categories.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        if (! in_array($sort, self::SORTABLE_COLUMNS, true)) {
            $sort = 'created_at';
        }

        if (! in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'desc';
        }

        $categories = Category::query()
            ->search($request->input('search'))
            ->status($request->input('status'))
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('admin.categories.index', compact(
            'categories',
            'sort',
            'direction'
        ));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $category = new Category();

        $category->name = $validated['name'];
        $category->slug = $this->generateUniqueSlug(
            $validated['name'],
            $validated['slug'] ?? null
        );
        $category->description = $validated['description'] ?? null;
        $category->meta_title = $validated['meta_title'] ?? null;
        $category->meta_description = $validated['meta_description'] ?? null;
        $category->meta_keywords = $validated['meta_keywords'] ?? null;
        $category->status = $validated['status'];

        $this->handleUploads($request, $category);

        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate($this->rules($category));

        $category->name = $validated['name'];
        $category->slug = $this->generateUniqueSlug(
            $validated['name'],
            $validated['slug'] ?? null,
            $category->id
        );
        $category->description = $validated['description'] ?? null;
        $category->meta_title = $validated['meta_title'] ?? null;
        $category->meta_description = $validated['meta_description'] ?? null;
        $category->meta_keywords = $validated['meta_keywords'] ?? null;
        $category->status = $validated['status'];

        $this->handleUploads($request, $category);

        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Category $category)
    {
        $this->deleteFile($category->image);
        $this->deleteFile($category->banner);
        $this->deleteFile($category->icon);

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Validation rules for store and update.
     */
    private function rules(?Category $category = null): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category?->id),
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('categories', 'slug')->ignore($category?->id),
            ],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'banner' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'boolean'],
        ];
    }

    /**
     * Generate a unique slug from name or custom slug input.
     */
    private function generateUniqueSlug(
        string $name,
        ?string $slug = null,
        ?int $exceptId = null
    ): string {
        $baseSlug = filled($slug) ? Str::slug($slug) : Str::slug($name);
        $candidate = $baseSlug;
        $counter = 1;

        while (
            Category::where('slug', $candidate)
                ->when($exceptId, fn ($query) => $query->where('id', '!=', $exceptId))
                ->exists()
        ) {
            $candidate = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $candidate;
    }

    /**
     * Handle image, banner and icon uploads.
     */
    private function handleUploads(Request $request, Category $category): void
    {
        $this->ensureUploadDirectoryExists();

        foreach (['image', 'banner', 'icon'] as $field) {
            if (! $request->hasFile($field)) {
                continue;
            }

            $this->deleteFile($category->{$field});

            $file = $request->file($field);
            $filename = time().'_'.$field.'_'.$file->getClientOriginalName();

            $file->move(public_path(self::UPLOAD_PATH), $filename);

            $category->{$field} = $filename;
        }
    }

    /**
     * Ensure the upload directory exists.
     */
    private function ensureUploadDirectoryExists(): void
    {
        $path = public_path(self::UPLOAD_PATH);

        if (! File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }

    /**
     * Delete a stored file if it exists.
     */
    private function deleteFile(?string $filename): void
    {
        if (! $filename) {
            return;
        }

        $path = public_path(self::UPLOAD_PATH.'/'.$filename);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
