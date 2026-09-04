@extends('layouts.admin')

@section('title', 'Negozi')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fs-3 mb-0">Negozi</h1>
                    <a href="{{ route('businesses.create') }}" class="btn-form-base btn-login">
                        <i class="bi bi-plus-lg"></i> Nuovo Negozio
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
                                    <th class="text-uppercase text-secondary small">Storia</th>
                                    <th class="text-uppercase text-secondary small">Indirizzo</th>
                                    <th class="text-uppercase text-secondary small">Contatti</th>
                                    <th class="text-uppercase text-secondary small">Immagine</th>
                                    <th class="text-uppercase text-secondary small">Categoria</th>
                                    <th class="text-uppercase text-secondary small">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($businesses as $business)
                                    <tr>
                                        <td class="align-middle fw-medium">
                                            {{ $business->name }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $business->story ? Str::limit($business->story, 50) : '-' }}
                                        </td>

                                        <td class="align-middle">
                                            {{ $business->address ?? '-' }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $business->contact ? 'Tel. ' . $business->contact : '-' }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $business->cover_image ?? 'nessun immagine aggiunta' }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $business->category->name }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <a href="{{ route('businesses.edit', $business) }}"
                                                    class="btn btn-outline-primary btn-sm rounded-circle">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <button type="button" class="btn btn-outline-danger btn-sm rounded-circle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteBusinessModal{{ $business->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-secondary py-4">
                                            Nessun negozio presente.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($businesses as $business)
        <div class="modal fade" id="deleteBusinessModal{{ $business->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Elimina negozio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare <strong>{{ $business->name }}</strong>? L'operazione non è
                        reversibile.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <form action="{{ route('businesses.destroy', $business) }}" method="POST">
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
