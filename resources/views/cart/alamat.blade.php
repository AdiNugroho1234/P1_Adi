<li>
    <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true"
        aria-controls="collapseThree">Alamat Pengiriman</h6>
    <section class="checkout-steps-form-content collapse show" id="collapseThree" aria-labelledby="headingThree"
        data-bs-parent="#accordionExample">

        <form action="{{ route('cart.checkout') }}" method="POST">
            <!-- Tambahkan ini jika kamu pakai Laravel -->
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <div class="row">
                <div class="col-md-12">
                    <div class="single-form form-default">
                        <label>Nama Penerima</label>
                        <div class="row">
                            <div class="col-md-6 form-input form">
                                <input type="text" name="first_name" placeholder="Nama Depan">
                            </div>
                            <div class="col-md-6 form-input form">
                                <input type="text" name="last_name" placeholder="Nama Belakang">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single-form form-default">
                        <label>Nomor Telepon</label>
                        <div class="form-input form">
                            <input type="text" name="telepon" placeholder="Contoh: 0821xxxxxx">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single-form form-default">
                        <label>Email</label>
                        <div class="form-input form">
                            <input type="email" name="email" placeholder="Email aktif">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="single-form form-default">
                        <label>Alamat Lengkap</label>
                        <div class="form-input form">
                            <input type="text" name="alamat" placeholder="Nama Jalan, RT/RW, Patokan, dll">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single-form form-default">
                        <label>Kota</label>
                        <div class="form-input form">
                            <input type="text" name="kota" placeholder="Contoh: Bandung">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single-form form-default">
                        <label>Kode Pos</label>
                        <div class="form-input form">
                            <input type="text" name="kode_pos" placeholder="Contoh: 40291">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single-form form-default">
                        <label>Negara</label>
                        <div class="form-input form">
                            <input type="text" name="negara" value="Indonesia">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single-form form-default">
                        <label>Provinsi</label>
                        <div class="select-items">
                            <select name="provinsi" class="form-control">
                                <option value="">Pilih Provinsi</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="DKI Jakarta">DKI Jakarta</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                                <!-- Tambahkan provinsi lain jika perlu -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="single-checkbox checkbox-style-3">
                        <input type="checkbox" id="checkbox-3" name="alamat_sama">
                        <label for="checkbox-3"><span></span></label>
                        <p>Alamat pengiriman sama dengan alamat tagihan</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="single-form button">
                        <button type="submit" class="btn">Simpan & Lanjut</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</li>