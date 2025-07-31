<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row justify-content-between">

            <div class="col-md-3">
                <div class="logo_content">
                    <a href="#" class="footerLogo">FutWin</a>
                    <p>Expert soccer betting predictions <br> from the Top 5 European leagues.</p>
                    <ul class="social-link">
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <h3>Quick Links</h3>
                <ul class="quicklist">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Expert Picks</a></li>
                    <li><a href="#">Leagues</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Leagues</h3>
                <ul class="quicklist">
                    <li><a href="#">Premier League</a></li>
                    <li><a href="#">La Liga</a></li>
                    <li><a href="#">Bundesliga</a></li>
                    <li><a href="#">Serie A</a></li>
                    <li><a href="#">Ligue 1</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Legal</h3>
                <ul class="quicklist">
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Responsible Gambling</a></li>
                    <li><a href="#">Disclaimer</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="row copyRight justify-content-center align-items-center">
            <div class="col-md-12">
                <p>&copy; <span id="currentyear"><?= date("Y") ?></span>FutWin. All Right Reserved.</p>
                <p>FutWin is an informational service. We do not provide gambling services or accept bets. Please bet responsibly.</p>
            </div>
        </div>
    </div>
</footer>
<!-- !FOOTER -->


<!-- ALL JS LIBRARIES -->
<script src="{{ asset('front/js/all.min.js') }}"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('front/js/custom.min.js') }}"></script>
@yield('scripts')


</body>

</html>
