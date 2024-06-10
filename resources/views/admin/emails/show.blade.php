@extends('layouts.admin')

@section('content')
    <header>
        <div class="container-fluid bg-dark py-3 text-danger shadow">
            <div class="container d-flex align-items-center justify-content-between">
                <h1>
                    <strong>
                        Email-id : {{ $email->id }}
                    </strong>
                </h1>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container py-5">
            @include('partials.session-message')
            <div class="row py-3 text-center">
                <div class="col-4"><span class="fw-bold">Email ID:</span></div>
                <div class="col-4"><span class="fw-bold">Name:</span></div>
                <div class="col-4"><span class="fw-bold">Email:</span></div>
            </div>
        </div>
        <div class="container">
            <div class="row text-center">
                <div class="col-4">
                    <span scope="row">{{ $email->id }}</span>
                </div>
                <div class="col-4">
                    <span scope="row">{{ $email->name }}</span>
                </div>
                <div class="col-4">
                    <span scope="row">{{ $email->email }}</span>
                </div>
            </div>
        </div>
        <div class="container py-3">
            <hr>
        </div>
        <div class="container">
            <div class="row text-center py-3">
                <div class="col-12">
                    <span class="fw-bold">Message:</span> <br>
                </div>
                <div class="col-12 mt-5">
                    <span scope="row">{{ $email->message }}</span>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <hr>
        </div>
        <div class="container py-5 d-flex align-items-center justify-content-between">
            <div class="d-flex">
                <div class="px-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalId-{{ $email->id }}">
                        <span class="px-2 fw-bold">
                            DELETE
                        </span>
                        <i class="fas fa-trash-can fa-lg fa-fw"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="modalId-{{ $email->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Are you sure to delete {{ $email->id }} email ?
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">❌care❌care❌</div>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('admin.emails.destroy', $email) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Delete this email
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <a class="btn btn-dark text-danger fw-bold" href="{{ route('admin.emails.index') }}">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>
                        RETURN TO EMAILS
                    </span>
                </a>
            </div>
        </div>
    </section>
@endsection
