@extends('layouts.admin')

@section('title', 'Categorie')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fs-3 mb-0">Categorie</h1>
                    <a href="{{ route('categories.create') }}" class="btn-form-base btn-login">
                        <i class="bi bi-plus-lg"></i> Nuova Categoria
                    </a>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-light table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary small">Nome</th>
                                    <th class="text-uppercase text-secondary small text-end">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td class="align-middle fw-medium">{{ $category->name }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <a href="{{ route('categories.edit', $category) }}"
                                                    class="btn btn-outline-primary btn-sm rounded-circle">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <button type="button" class="btn btn-outline-danger btn-sm rounded-circle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteCategoryModal{{ $category->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">Nessuna categoria
                                            salvata</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach ($categories as $category)
        <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Elimina categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare <strong>{{ $category->name }}</strong>? L'operazione non è
                        reversibile.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
