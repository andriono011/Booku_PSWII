@extends('themes.ezone.layout')
@section('content')
<br>	
 <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 style="color:#154A71;" class="mb-5">Hubungi Untuk Setiap Pertanyaan</h1>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <h5 class="section-title  text-primary">Pemesanan</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>kelompok12@gmail.com</p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="section-title text-primary">Umum</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>bookushoop@gmail.com</p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="section-title  text-primary">Technical</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>adminbookushop@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                        <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15945.801385267878!2d99.1259422153882!3d2.354376922546202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e012d8853f9a5%3A0xf2f2f4bb70d920d0!2sLagoeboti%2C%20Simatibung%2C%20Kec.%20Laguboti%2C%20Toba%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1652889994815!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-md-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                        <label for="name">Nama Anda</label>
                                            <input type="text" class="form-control" id="name" placeholder="Nama Anda">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                        <label for="email">Email Anda</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email Anda">
                                           
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                        <label for="message">Pesan</label>
                                            <textarea class="form-control" placeholder="Tinggalkan Pesan disini" id="message" style="height: 150px"></textarea>
                                           
                                        </div>
                                    </div>
                                  
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 h-100" type="submit" style="background-color:#154A71">Kirim Pesan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
                                </tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection