<?php
/**
 * Template Name: Vacasky Homepage
 */
get_header();
?>

<style>header.site-header, .site-footer { display: none !important; }</style>

<div class="w-full overflow-x-hidden bg-white text-vacasky-dark font-sans antialiased">

    <section class="relative min-h-screen flex items-center py-20 px-6 lg:px-20">
        <div class="container mx-auto max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div class="order-2 lg:order-1 text-center lg:text-left">
                    <span class="block text-sm font-bold tracking-[0.2em] text-vacasky-gray mb-4 uppercase">
                        Premium Cycling Tour
                    </span>
                    <h1 class="text-5xl lg:text-7xl font-heading font-bold uppercase leading-tight mb-6 text-vacasky-dark">
                        Explore The <br>
                        <span class="text-vacasky-blue">Sunrise of Java</span>
                    </h1>
                    <p class="text-vacasky-gray text-lg mb-10 leading-relaxed max-w-lg mx-auto lg:mx-0">
                        Platform sewa sepeda road bike premium & paket tour lengkap di Banyuwangi. Unit terawat, guide profesional.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        <a href="#booking" class="bg-vacasky-blue text-white px-8 py-4 rounded-lg font-heading font-bold uppercase tracking-wider hover:bg-blue-600 transition shadow-lg hover:-translate-y-1">
                            Book Now
                        </a>
                        <a href="#how" class="bg-transparent border-2 border-gray-200 text-vacasky-dark px-8 py-4 rounded-lg font-heading font-bold uppercase tracking-wider hover:bg-vacasky-dark hover:border-vacasky-dark hover:text-white transition">
                            How it Works
                        </a>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-100 flex gap-12 justify-center lg:justify-start">
                        <div>
                            <h4 class="text-3xl font-heading font-bold">500+</h4>
                            <span class="text-xs text-gray-400 font-bold tracking-widest uppercase">Riders</span>
                        </div>
                        <div>
                            <h4 class="text-3xl font-heading font-bold">15+</h4>
                            <span class="text-xs text-gray-400 font-bold tracking-widest uppercase">Routes</span>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 relative">
                    <div class="relative h-[500px] w-full rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1200&auto=format&fit=crop" 
                             class="w-full h-full object-cover" alt="Banyuwangi Landscape">
                        
                        <div class="hidden md:flex absolute bottom-8 left-8 bg-white p-6 rounded-xl shadow-xl items-center gap-4 max-w-xs">
                            <div class="w-12 h-12 bg-vacasky-blue rounded-full flex items-center justify-center text-white shrink-0">
                                <i class="fas fa-play ml-1"></i>
                            </div>
                            <div>
                                <h6 class="font-heading font-bold text-sm uppercase">Watch Video</h6>
                                <p class="text-xs text-gray-500">See the journey</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -z-10 top-6 right-6 w-full h-full border-2 border-vacasky-blue/20 rounded-2xl"></div>
                </div>

            </div>
        </div>
    </section>

    <section id="how" class="py-24 px-6 bg-vacasky-light">
        <div class="container mx-auto max-w-7xl">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <span class="text-vacasky-blue font-bold tracking-widest uppercase text-sm mb-2 block">Simple Steps</span>
                    <h2 class="text-4xl lg:text-5xl font-heading font-bold uppercase">How To Start</h2>
                </div>
                <div class="md:text-right">
                    <p class="text-vacasky-gray">Hanya 3 langkah mudah untuk memulai<br>petualangan gowes Anda.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 bg-vacasky-light text-vacasky-blue rounded-xl flex items-center justify-center text-2xl mb-8">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4 class="font-heading font-bold text-xl mb-4 uppercase">1. Choose Route</h4>
                    <p class="text-vacasky-gray text-sm leading-relaxed">
                        Pilih rute sesuai stamina Anda. Dari tanjakan Ijen hingga fun bike pantai.
                    </p>
                </div>

                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 bg-vacasky-light text-vacasky-blue rounded-xl flex items-center justify-center text-2xl mb-8">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4 class="font-heading font-bold text-xl mb-4 uppercase">2. Book Date</h4>
                    <p class="text-vacasky-gray text-sm leading-relaxed">
                        Tentukan tanggal keberangkatan. Pembayaran aman dan instan via QRIS.
                    </p>
                </div>

                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 bg-vacasky-light text-vacasky-blue rounded-xl flex items-center justify-center text-2xl mb-8">
                        <i class="fas fa-bicycle"></i>
                    </div>
                    <h4 class="font-heading font-bold text-xl mb-4 uppercase">3. Start Riding</h4>
                    <p class="text-vacasky-gray text-sm leading-relaxed">
                        Datang ke titik kumpul. Unit sepeda premium sudah disetting dan siap digunakan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="booking" class="py-24 px-6 bg-white">
        <div class="container mx-auto max-w-7xl">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-vacasky-dark font-bold tracking-widest uppercase text-sm mb-2 block">Destinations</span>
                    <h2 class="text-4xl lg:text-5xl font-heading font-bold uppercase">Popular Tours</h2>
                </div>
                <a href="/shop" class="hidden md:inline-block border-b-2 border-gray-200 pb-1 font-heading font-bold uppercase hover:text-vacasky-blue hover:border-vacasky-blue transition">
                    View All Tours
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php echo do_shortcode('[products limit="3" columns="3"]'); ?>
            </div>
            
            <div class="mt-12 text-center md:hidden">
                <a href="/shop" class="inline-block border-2 border-vacasky-dark px-6 py-3 rounded font-heading font-bold uppercase">View All Tours</a>
            </div>
        </div>
    </section>

    <section class="py-24 px-6">
        <div class="container mx-auto max-w-5xl">
            <div class="bg-vacasky-blue rounded-2xl p-12 lg:p-20 text-center text-white">
                <h2 class="text-3xl lg:text-5xl font-heading font-bold uppercase mb-6">Custom Your Trip?</h2>
                <p class="text-white/90 text-lg mb-10 max-w-2xl mx-auto">
                    Kami melayani grup perusahaan atau keluarga besar dengan fasilitas support car, dokumentasi drone, dan rute fleksibel.
                </p>
                <a href="https://wa.me/628123456789" class="inline-flex items-center gap-3 bg-white text-vacasky-blue px-10 py-4 rounded-lg font-heading font-bold uppercase tracking-wider hover:bg-gray-100 transition shadow-lg">
                    <i class="fab fa-whatsapp text-xl"></i> Whatsapp Us
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-vacasky-dark text-white py-20 border-t border-gray-800">
        <div class="container mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-1">
                    <a href="/" class="font-heading font-bold text-3xl uppercase tracking-widest mb-6 block">Banyuwangi.</a>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Experience the best cycling tour in East Java. Premium bikes, professional guides.
                    </p>
                </div>

                <div>
                    <h6 class="font-heading font-bold uppercase tracking-widest mb-6 text-sm text-gray-200">Menu</h6>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="/" class="hover:text-white transition">Home</a></li>
                        <li><a href="/shop" class="hover:text-white transition">Rental</a></li>
                        <li><a href="#booking" class="hover:text-white transition">Tours</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="font-heading font-bold uppercase tracking-widest mb-6 text-sm text-gray-200">Support</h6>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="font-heading font-bold uppercase tracking-widest mb-6 text-sm text-gray-200">Contact</h6>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-vacasky-blue"></i>
                            <span>Jl. Kawah Ijen 123,<br>Banyuwangi</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-vacasky-blue"></i>
                            <span class="font-bold text-white">+62 812 3456 789</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center md:text-left flex flex-col md:flex-row justify-between items-center text-gray-500 text-xs">
                <p>&copy; <?php echo date('Y'); ?> Banyuwangi Cycling Tours. All rights reserved.</p>
            </div>
        </div>
    </footer>

</div>

<?php get_footer(); ?>