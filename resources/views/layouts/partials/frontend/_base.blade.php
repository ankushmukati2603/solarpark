 <script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/jquery-ui.min.js') }}"></script>
 <!-- <script src="{{ URL::asset('public/js/jquery.validate.min.js') }}"></script> 
 <script src="{{ URL::asset('public/js/base_forms_validation.js') }}"></script>
 <script src="{{ URL::asset('public/js/password-validation.js') }}"></script>
<script src="{{ URL::asset('public/js/dataTables.bootstrap.min.js') }}"></script>
-->
 <script src="{{ URL::asset('public/js/icheck.min.js') }}"></script>

 <script src="{{ URL::asset('public/js/bootstrap.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/Chart.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/bootstrap-datepicker.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/bootstrap3-wysihtml5.all.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/adminlte.min.js') }}"></script>




 <script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
 <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
 <script src="{{ URL::asset('public/js/select2.full.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ URL::asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.2/dist/Chart.min.js"></script> -->

 <script src="{{ URL::asset('public/assets/js/main.js') }}"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/css3-animate-it/1.0.3/js/css3-animate-it.min.js"
     integrity="sha512-X04knNLL77jarDJ7uTIUXMBvZwMCWn2lmV9qPrfq7UrPPd3GP5a4IVbZBkRNI/vumMMMqOZqnNLq8Eb/Y6TU7A=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script type="text/javascript" src="{{asset('public/sweetalert2/sweetalert2.min.js?202206071444')}}"></script>
 @if(Request::path()== 'log-in1')
 <script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
 @endif
 <script>
window.onscroll = function() {
    myFunction()
};

var navbar = document.getElementById("stick_nav");
var sticky = navbar.offsetTop;

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}

$(document).ready(function() {
    $('.customer-logos').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 760,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 1
            }
        }]
    });
});
 </script>


 <script type="text/javascript">
var baseUrl = '{{URL::to("/")}}';
var validator = '';
@if(Session::has('msg'))
$('#msgModal').modal('show');
@endif
 </script>



 <script src="{{ URL::asset('public/js/common.js') }}"></script>
 <script>
function openPage(pageName, elmnt, color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
// document.getElementById("defaultOpen").click();
 </script>

 <script>
(function() {
    var $gallery = new SimpleLightbox('.gallery a', {});
})();
 </script>
 <script>
jQuery(function() {
    //caches a jQuery object containing the header element
    var header = $(".navbar");
    jQuery(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            header.addClass("darkHeader");
        } else {
            header.removeClass("darkHeader");
        }
    });
});

jQuery(document).ready(function() {
    jQuery('.mnre_employes_says').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: true,
        dots: false,
        pauseOnHover: true,
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});

var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) {
        delta /= 2;
    }

    if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
    }

    setTimeout(function() {
        that.tick();
    }, delta);
};

window.onload = function() {
    var elements = document.getElementsByClassName('typewrite');
    for (var i = 0; i < elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
            new TxtType(elements[i], JSON.parse(toRotate), period);
        }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
};

const counters = document.querySelectorAll('.value');
const speed = 400;

counters.forEach(counter => {
    const animate = () => {
        const value = +counter.getAttribute('akhi');
        const data = +counter.innerText;

        const time = value / speed;
        if (data < value) {
            counter.innerText = Math.ceil(data + time);
            setTimeout(animate, 1);
        } else {
            counter.innerText = value;
        }

    }

    animate();
});
 </script>