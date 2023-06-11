<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Bankify</title>
    <link rel="shortcut icon" type="image/png" href="img/icon.png" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/utility.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script defer src="js/script.js"></script>
</head>

<body>
    <header class="header">
        <nav class="nav">
            <img src="img/logo.png" alt="Bankify logo" class="nav__logo" id="logo" designer="Rahul"
                data-version-number="1.0" />
            <ul class="nav__links">
                <li class="nav__item">
                    <a class="nav__link nav__link-static" href="#section--1">Features</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link nav__link-static" href="#section--2">Operations</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link nav__link-static" href="#section--3">Testimonials</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link nav__link--btn btn--show-modal" href="#">Login</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link nav__link--btn2" href="signup.php">Signup</a>
                </li>
            </ul>
        </nav>

        <div class="header__title">
            <h1>
                When
                <!-- Green highlight effect -->
                <span class="highlight">banking</span>
                meets<br />
                <span class="highlight">minimalist</span>
            </h1>
            <h4>A simpler banking experience for a simpler life.</h4>
            <button class="btn--text btn--scroll-to">Learn more &DownArrow;</button>
            <img src="img/hero.png" class="header__img" alt="Minimalist bank items" />
        </div>
    </header>

    <section class="section" id="section--1">
        <div class="section__title">
            <h2 class="section__description">Features</h2>
            <h3 class="section__header">
                Everything you need in a modern bank and more.
            </h3>
        </div>

        <div class="features">
            <img src="img/digital-lazy.jpg" data-src="img/digital.jpg" alt="Computer" class="features__img lazy-img" />
            <div class="features__feature">
                <div class="features__icon">
                    <svg>
                        <use xlink:href="img/icons.svg#icon-monitor"></use>
                    </svg>
                </div>
                <h5 class="features__header">100% digital bank</h5>
                <p>
                    Experience the convenience and flexibility of a 100% digital bank. Join the growing number of
                    individuals who are embracing the future of banking. Seamlessly manage your finances, access
                    innovative features, and enjoy a hassle-free banking experience like never before.
                </p>
            </div>

            <div class="features__feature">
                <div class="features__icon">
                    <svg>
                        <use xlink:href="img/icons.svg#icon-trending-up"></use>
                    </svg>
                </div>
                <h5 class="features__header">Watch your money grow</h5>
                <p>
                    Watch your money grow with our investment platform. Join the thousands of individuals who have
                    entrusted us with their financial future. Start your journey towards financial growth and success
                    today.
                </p>
            </div>
            <img src="img/grow-lazy.jpg" data-src="img/grow.jpg" alt="Plant" class="features__img lazy-img" />

            <img src="img/card-lazy.jpg" data-src="img/card.jpg" alt="Credit card" class="features__img lazy-img" />
            <div class="features__feature">
                <div class="features__icon">
                    <svg>
                        <use xlink:href="img/icons.svg#icon-credit-card"></use>
                    </svg>
                </div>
                <h5 class="features__header">Customized user Interface for different users</h5>
                <p>
                    At our platform, we believe in providing a personalized experience for every user. With our
                    customized user interface, we cater to the unique preferences and needs of individual users,
                    ensuring a seamless and tailored interaction.
                </p>
            </div>
        </div>
    </section>

    <section class="section" id="section--2">
        <div class="section__title">
            <h2 class="section__description">Operations</h2>
            <h3 class="section__header">
                Everything as simple as possible, but no simpler.
            </h3>
        </div>

        <div class="operations">
            <div class="operations__tab-container">
                <button class="btn operations__tab operations__tab--1 operations__tab--active" data-tab="1">
                    <span>01</span>Instant Transfers
                </button>
                <button class="btn operations__tab operations__tab--2" data-tab="2">
                    <span>02</span>Instant Loans
                </button>
                <button class="btn operations__tab operations__tab--3" data-tab="3">
                    <span>03</span>Instant Closing
                </button>
            </div>
            <div class="operations__content operations__content--1 operations__content--active">
                <div class="operations__icon operations__icon--1">
                    <svg>
                        <use xlink:href="img/icons.svg#icon-upload"></use>
                    </svg>
                </div>
                <h5 class="operations__header">
                    Transfer money to anyone, instantly! No fees, no BS.
                </h5>
                <p>
                    With our revolutionary money transfer service, sending money to anyone has never been easier or
                    faster. Say goodbye to excessive fees and unnecessary complications. Our streamlined process ensures
                    that you can transfer funds instantly, hassle-free, and without any hidden charges.
                </p>
            </div>

            <div class="operations__content operations__content--2">
                <div class="operations__icon operations__icon--2">
                    <svg>
                        <use xlink:href="img/icons.svg#icon-home"></use>
                    </svg>
                </div>
                <h5 class="operations__header">
                    Buy a home or make your dreams come true, with instant loans.
                </h5>
                <p>
                    Imagine owning your dream home or bringing your long-awaited aspirations to life. With our instant
                    loan services, you can turn those dreams into reality without delay. Whether you're planning to
                    purchase a new home, renovate your existing property, or fulfill any other personal goal, our
                    hassle-free loan process is here to make it happen.
                </p>
            </div>
            <div class="operations__content operations__content--3">
                <div class="operations__icon operations__icon--3">
                    <svg>
                        <use xlink:href="img/icons.svg#icon-user-x"></use>
                    </svg>
                </div>
                <h5 class="operations__header">
                    No longer need your account? No problem! Close it instantly.
                </h5>
                <p>
                    Experience the peace of mind that comes with knowing you have the ability to close your account
                    instantly, hassle-free. We appreciate the opportunity to serve you and understand that circumstances
                    may change. When it's time to move on, we're here to make it a seamless and efficient process.
                </p>
            </div>
        </div>
    </section>

    <section class="section" id="section--3">
        <div class="section__title section__title--testimonials">
            <h2 class="section__description">Not sure yet?</h2>
            <h3 class="section__header">
                Millions of Bankify's are already making their life simpler.
            </h3>
        </div>

        <div class="slider">
            <div class="slide slide--1">
                <div class="testimonial">
                    <h5 class="testimonial__header">Best financial decision ever!</h5>
                    <blockquote class="testimonial__text">
                        From the moment I joined, I was impressed by the range of financial solutions they offer.
                        Whether it's banking, investments, loans, or any other financial need, they have it covered. The
                        convenience of having everything in one place has simplified my financial life and saved me
                        valuable time.
                    </blockquote>
                    <address class="testimonial__author">
                        <img src="img/user-1.jpg" alt="" class="testimonial__photo" />
                        <h6 class="testimonial__name">Seenu Vasan</h6>
                        <p class="testimonial__location">Karnataka, India</p>
                    </address>
                </div>
            </div>

            <div class="slide slide--2">
                <div class="testimonial">
                    <h5 class="testimonial__header">
                        The last step to becoming a complete minimalist
                    </h5>
                    <blockquote class="testimonial__text">
                        With their seamless digital platform, I can effortlessly handle all my financial needs in one
                        place. From banking and budgeting to investments and loans, everything is streamlined and easily
                        accessible. The clutter and complexity of traditional banking are replaced with simplicity and
                        efficiency.
                    </blockquote>
                    <address class="testimonial__author">
                        <img src="img/user-2.jpg" alt="" class="testimonial__photo" />
                        <h6 class="testimonial__name">Rishi Sunaik</h6>
                        <p class="testimonial__location">London, UK</p>
                    </address>
                </div>
            </div>

            <div class="slide slide--3">
                <div class="testimonial">
                    <h5 class="testimonial__header">
                        Finally free from old-school banks
                    </h5>
                    <blockquote class="testimonial__text">
                        One of the things I appreciate most about Bankify is their commitment to transparency. They have
                        eradicated hidden fees and complicated jargon, allowing me to understand my finances with
                        clarity. I can trust that what I see is what I get, no surprises or hidden costs.
                    </blockquote>
                    <address class="testimonial__author">
                        <img src="img/user-3.jpeg" alt="" class="testimonial__photo" />
                        <h6 class="testimonial__name">Christiano Ronaldo</h6>
                        <p class="testimonial__location">Lisbon, Portugal</p>
                    </address>
                </div>
            </div>

            <!-- <div class="slide"><img src="img/img-1.jpg" alt="Photo 1" /></div>
        <div class="slide"><img src="img/img-2.jpg" alt="Photo 2" /></div>
        <div class="slide"><img src="img/img-3.jpg" alt="Photo 3" /></div>
        <div class="slide"><img src="img/img-4.jpg" alt="Photo 4" /></div> -->
            <button class="slider__btn slider__btn--left">&larr;</button>
            <button class="slider__btn slider__btn--right">&rarr;</button>
            <div class="dots"></div>
        </div>
    </section>

    <section class="section section--sign-up">
        <div class="section__title">
            <h3 class="section__header">
                The best day to join Bankify was one year ago. The second best is
                today!
            </h3>
        </div>
        <button class="btn"><a class="" href="signup.php">Open your free account today!</a></button>
    </section>

    <footer class="footer">
        <ul class="footer__nav">
            <li class="footer__item">
                <a class="footer__link" href="#">About</a>
            </li>
            <li class="footer__item">
                <a class="footer__link" href="#">Pricing</a>
            </li>
            <li class="footer__item">
                <a class="footer__link" href="#">Terms of Use</a>
            </li>
            <li class="footer__item">
                <a class="footer__link" href="#">Privacy Policy</a>
            </li>
            <li class="footer__item">
                <a class="footer__link" href="#">Careers</a>
            </li>
            <li class="footer__item">
                <a class="footer__link" href="#">Blog</a>
            </li>
            <li class="footer__item">
                <a class="footer__link" href="#">Contact Us</a>
            </li>
        </ul>
        <img src="img/icon.png" alt="Logo" class="footer__logo" />
    </footer>

    <div class="modal hidden">
        <button class="btn--close-modal">&times;</button>
        <h2 class="modal__header">
            Login to your <span class="highlight">Bankify</span> account
        </h2>
        <form id="loginForm" class="modal__form">
            <label>Email</label>
            <input type="text" name="email" />
            <label>Password</label>
            <input type="password" name="password" />
            <span class="modal-error-message error-message" id="errorMessage"></span>
            <button class="btn">Login &rarr;</button>
        </form>
    </div>
    <div class="overlay hidden"></div>
</body>

</html>