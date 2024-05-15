document.addEventListener("DOMContentLoaded", function() {
    var links = document.querySelectorAll('a[href^="#"]');
    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener("click", smoothScroll);
    }

    function smoothScroll(e) {
        e.preventDefault();
        var targetId = this.getAttribute("href").substring(1);
        var targetElement = document.getElementById(targetId);
        var startPosition = window.pageYOffset;
        var targetPosition = targetElement.getBoundingClientRect().top + startPosition;
        var distance = targetPosition - startPosition;
        var duration = 800;
        var start = null;

        function animation(currentTime) {
            if (start === null) start = currentTime;
            var timeElapsed = currentTime - start;
            var run = ease(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        function ease(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        requestAnimationFrame(animation);
    }
});