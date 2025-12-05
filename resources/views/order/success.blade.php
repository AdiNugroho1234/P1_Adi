@extends('layouts.app')

@section('content')
<section class="checkout-wrapper section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="checkout-steps-form-style-1">
                    <ul id="accordionExample">
                        <li>
                            <h6 class="title text-success" data-bs-toggle="collapse"
                                data-bs-target="#collapseSuccess" aria-expanded="true"
                                aria-controls="collapseSuccess">
                                Pembayaran Berhasil
                            </h6>

                            <section class="checkout-steps-form-content collapse show" id="collapseSuccess"
                                aria-labelledby="headingSuccess" data-bs-parent="#accordionExample">

                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <div class="single-form form-default text-center py-5">
                                            <div class="mb-4">


                                                <h4 class="text-success mb-3">Pembayaran Berhasil!</h4>
                                                <p class="text-muted">
                                                    Terima kasih telah menyelesaikan pembayaran. Pesanan kamu sedang diproses dan akan segera dikirim ke alamat tujuan.
                                                </p>

                                                <div class="single-form button mt-4">
                                                    <a href="{{ url('/') }}" class="btn btn-primary">
                                                        Kembali ke Beranda
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection