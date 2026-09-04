@extends('layouts.admin')

@section('title', 'Tratti distintivi')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fs-3 mb-0">Tratti distintivi</h1>
                    <a href="{{ route('distinctive-traits.create') }}" class="btn-form-base btn-login">
                        <i class="bi bi-plus-lg"></i> Nuovo tratto distintivo
                    </a>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <th class="text-uppercase text-secondary small fw-semibold">Nome</th>
                                    <th class="text-uppercase text-secondary small fw-semibold text-end">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($distinctiveTraits as $distinctiveTrait)
                                    <tr>
                                        <td class="align-middle fw-medium">{{ $distinctiveTrait->name }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <a href="{{ route('distinctive-traits.edit', $distinctiveTrait) }}"
                                                    class="btn btn-outline-primary btn-sm rounded-circle">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <button type="button" class="btn btn-outline-danger btn-sm rounded-circle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteCategoryModal{{ $distinctiveTrait->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-5">Nessun tratto distintivo
                                            salvato</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach ($distinctiveTraits as $distinctiveTrait)
        <div class="modal fade" id="deleteCategoryModal{{ $distinctiveTrait->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Elimina tratto distintivo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare <strong>{{ $distinctiveTrait->name }}</strong>? L'operazione non è
                        reversibile.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <form action="{{ route('distinctive-traits.destroy', $distinctiveTrait) }}" method="POST">
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
