<footer class="bg-gradient-to-br from-primary-800 to-primary-900 text-white pt-20 pb-10 relative overflow-hidden mt-20">
    <!-- Decorative circles -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-gold-500/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary-500/10 rounded-full translate-x-1/2 translate-y-1/2"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

            <!-- Brand -->
            <div>
                <h3 class="text-2xl font-black mb-4 flex items-center gap-2">
                    <span>🏔️</span> {{ app()->getLocale() === 'en' ? 'Afghan Quest' : 'افغان کویست' }}
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    {{ app()->getLocale() === 'en' ? 'Experience the best travel to Afghanistan with us. Explore the most beautiful historical and natural destinations.' : 'بهترین تجربه سفر به افغانستان را با ما داشته باشید. کاوش در زیباترین مکان ها تاریخی و طبیعی.' }}
                </p>
                <div class="flex gap-3 mt-6">
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-gold-500 hover:text-primary-900 transition-all duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-gold-500 hover:text-primary-900 transition-all duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-gold-500 hover:text-primary-900 transition-all duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-gold-500 hover:text-primary-900 transition-all duration-300">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h5 class="text-lg font-bold mb-4 text-gold-400">{{ app()->getLocale() === 'en' ? 'Quick Links' : 'دسترسی سریع' }}</h5>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-gold-400 transition-colors">{{ app()->getLocale() === 'en' ? 'Home' : 'صفحه اصلی' }}</a></li>
                    <li><a href="{{ route('provinces.index') }}" class="text-gray-400 hover:text-gold-400 transition-colors">{{ app()->getLocale() === 'en' ? 'Provinces' : 'ولایات' }}</a></li>
                    <li><a href="{{ route('destinations.index') }}" class="text-gray-400 hover:text-gold-400 transition-colors">{{ app()->getLocale() === 'en' ? 'Destinations' : 'مکان ها' }}</a></li>
                    <li><a href="{{ route('packages.index') }}" class="text-gray-400 hover:text-gold-400 transition-colors">{{ app()->getLocale() === 'en' ? 'Tours' : 'پکیج‌ها' }}</a></li>
                    <li><a href="{{ route('hotels.index') }}" class="text-gray-400 hover:text-gold-400 transition-colors">{{ app()->getLocale() === 'en' ? 'Hotels' : 'هوتل‌ها' }}</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h5 class="text-lg font-bold mb-4 text-gold-400">{{ app()->getLocale() === 'en' ? 'Contact Us' : 'تماس با ما' }}</h5>
                <ul class="space-y-3">
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-map-marker-alt text-gold-400 w-5"></i>
                        {{ app()->getLocale() === 'en' ? 'Kabul, Afghanistan' : 'کابل، افغانستان' }}
                    </li>
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-phone text-gold-400 w-5"></i>
                        <a href="tel:+93790784091" class="hover:text-gold-400 transition-colors">+93 790 784 091</a>
                    </li>
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fab fa-whatsapp text-gold-400 w-5"></i>
                        <a href="https://wa.me/93790784091" target="_blank" class="hover:text-gold-400 transition-colors">+93 790 784 091</a>
                    </li>
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-envelope text-gold-400 w-5"></i>
                        <a href="mailto:info@afghanquest.com" class="hover:text-gold-400 transition-colors">info@afghanquest.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="border-white/10 mb-6">
        <p class="text-center text-gray-500">
            {{ app()->getLocale() === 'en' ? '© 2025 Afghan Quest. All rights reserved.' : '© ۱۴۰۳ افغان کویست. تمامی حقوق محفوظ است.' }}
        </p>
    </div>
</footer>
