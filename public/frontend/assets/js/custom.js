/**---------------------------------
 * CRITICAL NOTICE
 ---------------------------------
 Make sure all the carcomparision html must be same to properly work
 with comparision. otherwise every thing will be messed
 */



$(document).ready(function () {
    // Retrieve comparisons from local storage
    var comparisons = JSON.parse(localStorage.getItem('comparisions')) || {};
    console.log(comparisons);
    var totalComparisons = Object.keys(comparisons).length;
    $('.main-total-comparisions').text(totalComparisons + (totalComparisons === 1 ? ' Car Added' : ' Cars Added'));

    // Iterate over all elements with class .btnCompare2
    $('.btnCompare2').each(function () {
        // Get the vehicle ID from the data attribute
        var vehicleID = $(this).data('vehicle-id');
        vehicleID = vehicleID.toString()

        if (isVehicleIDInComparisons(comparisons, vehicleID)) {
            $(this).addClass('active');
        }

    });

    $('.btnCompareFeaturedLogedIn').each(function () {
        // Get the vehicle ID from the data attribute
        var vehicleID = $(this).data('vehicle-id');
        vehicleID = vehicleID.toString()

        if (isVehicleIDInComparisons(comparisons, vehicleID)) {
            $(this).addClass('active');
        }

    });

    $(document).on('click', ".btnCompare2", function () {
        var vehicleID = $(this).data('vehicle-id');
        vehicleID = vehicleID.toString();
        var comparisons = JSON.parse(localStorage.getItem('comparisions')) || {};
        if (isVehicleIDInComparisons(comparisons, vehicleID)) {
            deletePropertyByValue(comparisons, vehicleID);
            $(this).removeClass('active');
        } else {
            SaveDataToLocalStorageWithoutKey(vehicleID);
            $(this).toggleClass('active');
        }
    });

    $(document).on('click', ".btnCompare", function () {
        var vehicleID = $(this).data('vehicle-id');
        var comparisions = JSON.parse(localStorage.getItem('comparisions')) || {};

        if (comparisions.hasOwnProperty(vehicleID)) {
            // Remove vehicleID if already present
            delete comparisions[vehicleID];
            $(this).removeClass('active');
        } else {
            SaveDataToLocalStorageWithoutKey(vehicleID)
            $(this).toggleClass('active');
        }
    });

    $(document).on('click', ".btnCompareFeaturedLogedIn", function () {
        var vehicleID = $(this).data('vehicle-id');
        vehicleID = vehicleID.toString();
        var comparisons = JSON.parse(localStorage.getItem('comparisions')) || {};
        if (isVehicleIDInComparisons(comparisons, vehicleID)) {
            deletePropertyByValue(comparisons, vehicleID);
            $(this).removeClass('active');
        } else {
            SaveDataToLocalStorageWithoutKey(vehicleID);
            $(this).toggleClass('active');
        }
    });

    $("li:first-child").addClass("first");
    $("li:last-child").addClass("last");
    $('[href="#"]').attr("href", "javascript:;");
    $(document).ready(function () {
        $('.menu-Bar').click(function () {
            $(this).toggleClass('open');
            $('.menuWrap').toggleClass('open');
            $('body').toggleClass('ovr-hiddn');
        });

        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll > 0) {
                $('.menuWrap').addClass('scroll-down');
            } else {
                $('.menuWrap').removeClass('scroll-down');
            }
        });
    });


    $('.loginUp').click(function () {
        $('.LoginPopup').fadeIn();
        $('.overlay').fadeIn();
    });

    $('.signUp').click(function () {
        $('.signUpPop').fadeIn();
        $('.overlay').fadeIn();
    });

    $('.closePop,.overlay').click(function () {
        $('.popupMain').fadeOut();
        $('.overlay').fadeOut();
    });

});


// Fancy Media
$('.fancybox-media').fancybox({
    openEffect: 'none',
    closeEffect: 'none',
    helpers: {
        media: {}
    }
});


// Slider For
$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    fade: false,
    asNavFor: '.slider-nav',
    prevArrow: $('.prev'),
    nextArrow: $('.next')
});
$('.slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    focusOnSelect: true,
    centerMode: true,
    centerPadding: '50px',
    arrows: true,
    prevArrow: $('.prev'),
    nextArrow: $('.next')
});


// Accordion
$('.myaccordi>li').click(function () {
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
});
//  https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_accordion


// Sticky Navigation
$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 200) {
        $(".fixed").addClass("sticky");
    } else {
        $(".fixed").removeClass("sticky");
    }
});


// Normal Slider
$('.index-slider').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: $('.prev0'),
    nextArrow: $('.next0'),
    responsive: [
        {
            breakpoint: 768, // breakpoint per dispositivi con larghezza massima di 768px (tablet e dispositivi mobili)
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
    ]
});


$('.popularSlider').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: $('.prev1'),
    nextArrow: $('.next1'),
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});


// Navigation Menu
$(window).on('load', function () {
    var currentUrl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
    $('ul.menu li a').each(function () {
        var hrefVal = $(this).attr('href');
        if (hrefVal == currentUrl) {
            $(this).removeClass('active');
            $(this).closest('li').addClass('active')
            $('ul.menu li.first').removeClass('active');
        }
    });

});

// Tabbing JS
$('[data-targetit]').on('click', function (e) {
    $(this).addClass('current');
    $(this).siblings().removeClass('current');
    var target = $(this).data('targetit');
    $('.' + target).siblings('[class^="box-"]').hide();
    $('.' + target).fadeIn();
    $(".tab-slider").slick("setPosition");
});

/* RESPONSIVE JS */
if ($(window).width() < 825) {
}

// Smooth Scrolling


// github repo => https://github.com/gblazex/smoothscroll-for-websites

//
// SmoothScroll for websites v1.4.10 (Balazs Galambosi)
// http://www.smoothscroll.net/
//
// Licensed under the terms of the MIT license.
//
// You may use it in your theme if you credit me.
// It is also free to use on any individual website.
//
// Exception:
// The only restriction is to not publish any
// extension for browsers or native application
// without getting a written permission first.
//

(function () {

    // Scroll Variables (tweakable)
    var defaultOptions = {

        // Scrolling Core
        frameRate: 150, // [Hz]
        animationTime: 400, // [ms]
        stepSize: 100, // [px]

        // Pulse (less tweakable)
        // ratio of "tail" to "acceleration"
        pulseAlgorithm: true,
        pulseScale: 4,
        pulseNormalize: 1,

        // Acceleration
        accelerationDelta: 50,  // 50
        accelerationMax: 3,   // 3

        // Keyboard Settings
        keyboardSupport: true,  // option
        arrowScroll: 50,    // [px]

        // Other
        fixedBackground: true,
        excluded: ''
    };

    var options = defaultOptions;


    // Other Variables
    var isExcluded = false;
    var isFrame = false;
    var direction = { x: 0, y: 0 };
    var initDone = false;
    var root = document.documentElement;
    var activeElement;
    var observer;
    var refreshSize;
    var deltaBuffer = [];
    var deltaBufferTimer;
    var isMac = /^Mac/.test(navigator.platform);

    var key = {
        left: 37, up: 38, right: 39, down: 40, spacebar: 32,
        pageup: 33, pagedown: 34, end: 35, home: 36
    };
    var arrowKeys = { 37: 1, 38: 1, 39: 1, 40: 1 };

    /***********************************************
     * INITIALIZE
     ***********************************************/

    /**
     * Tests if smooth scrolling is allowed. Shuts down everything if not.
     */
    function initTest() {
        if (options.keyboardSupport) {
            addEvent('keydown', keydown);
        }
    }

    /**
     * Sets up scrolls array, determines if frames are involved.
     */
    function init() {

        if (initDone || !document.body) return;

        initDone = true;

        var body = document.body;
        var html = document.documentElement;
        var windowHeight = window.innerHeight;
        var scrollHeight = body.scrollHeight;

        // check compat mode for root element
        root = (document.compatMode.indexOf('CSS') >= 0) ? html : body;
        activeElement = body;

        initTest();

        // Checks if this script is running in a frame
        if (top != self) {
            isFrame = true;
        }

        /**
         * Safari 10 fixed it, Chrome fixed it in v45:
         * This fixes a bug where the areas left and right to
         * the content does not trigger the onmousewheel event
         * on some pages. e.g.: html, body { height: 100% }
         */
        else if (isOldSafari &&
            scrollHeight > windowHeight &&
            (body.offsetHeight <= windowHeight ||
                html.offsetHeight <= windowHeight)) {

            var fullPageElem = document.createElement('div');
            fullPageElem.style.cssText = 'position:absolute; z-index:-10000; ' +
                'top:0; left:0; right:0; height:' +
                root.scrollHeight + 'px';
            document.body.appendChild(fullPageElem);

            // DOM changed (throttled) to fix height
            var pendingRefresh;
            refreshSize = function () {
                if (pendingRefresh) return; // could also be: clearTimeout(pendingRefresh);
                pendingRefresh = setTimeout(function () {
                    if (isExcluded) return; // could be running after cleanup
                    fullPageElem.style.height = '0';
                    fullPageElem.style.height = root.scrollHeight + 'px';
                    pendingRefresh = null;
                }, 500); // act rarely to stay fast
            };

            setTimeout(refreshSize, 10);

            addEvent('resize', refreshSize);

            // TODO: attributeFilter?
            var config = {
                attributes: true,
                childList: true,
                characterData: false
                // subtree: true
            };

            observer = new MutationObserver(refreshSize);
            observer.observe(body, config);

            if (root.offsetHeight <= windowHeight) {
                var clearfix = document.createElement('div');
                clearfix.style.clear = 'both';
                body.appendChild(clearfix);
            }
        }

        // disable fixed background
        if (!options.fixedBackground && !isExcluded) {
            body.style.backgroundAttachment = 'scroll';
            html.style.backgroundAttachment = 'scroll';
        }
    }

    /**
     * Removes event listeners and other traces left on the page.
     */
    function cleanup() {
        observer && observer.disconnect();
        removeEvent(wheelEvent, wheel);
        removeEvent('mousedown', mousedown);
        removeEvent('keydown', keydown);
        removeEvent('resize', refreshSize);
        removeEvent('load', init);
    }


    /************************************************
     * SCROLLING
     ************************************************/

    var que = [];
    var pending = false;
    var lastScroll = Date.now();

    /**
     * Pushes scroll actions to the scrolling queue.
     */
    function scrollArray(elem, left, top) {

        directionCheck(left, top);

        if (options.accelerationMax != 1) {
            var now = Date.now();
            var elapsed = now - lastScroll;
            if (elapsed < options.accelerationDelta) {
                var factor = (1 + (50 / elapsed)) / 2;
                if (factor > 1) {
                    factor = Math.min(factor, options.accelerationMax);
                    left *= factor;
                    top *= factor;
                }
            }
            lastScroll = Date.now();
        }

        // push a scroll command
        que.push({
            x: left,
            y: top,
            lastX: (left < 0) ? 0.99 : -0.99,
            lastY: (top < 0) ? 0.99 : -0.99,
            start: Date.now()
        });

        // don't act if there's a pending queue
        if (pending) {
            return;
        }

        var scrollRoot = getScrollRoot();
        var isWindowScroll = (elem === scrollRoot || elem === document.body);

        // if we haven't already fixed the behavior,
        // and it needs fixing for this sesh
        if (elem.$scrollBehavior == null && isScrollBehaviorSmooth(elem)) {
            elem.$scrollBehavior = elem.style.scrollBehavior;
            elem.style.scrollBehavior = 'auto';
        }

        var step = function (time) {

            var now = Date.now();
            var scrollX = 0;
            var scrollY = 0;

            for (var i = 0; i < que.length; i++) {

                var item = que[i];
                var elapsed = now - item.start;
                var finished = (elapsed >= options.animationTime);

                // scroll position: [0, 1]
                var position = (finished) ? 1 : elapsed / options.animationTime;

                // easing [optional]
                if (options.pulseAlgorithm) {
                    position = pulse(position);
                }

                // only need the difference
                var x = (item.x * position - item.lastX) >> 0;
                var y = (item.y * position - item.lastY) >> 0;

                // add this to the total scrolling
                scrollX += x;
                scrollY += y;

                // update last values
                item.lastX += x;
                item.lastY += y;

                // delete and step back if it's over
                if (finished) {
                    que.splice(i, 1); i--;
                }
            }

            // scroll left and top
            if (isWindowScroll) {
                window.scrollBy(scrollX, scrollY);
            }
            else {
                if (scrollX) elem.scrollLeft += scrollX;
                if (scrollY) elem.scrollTop += scrollY;
            }

            // clean up if there's nothing left to do
            if (!left && !top) {
                que = [];
            }

            if (que.length) {
                requestFrame(step, elem, (1000 / options.frameRate + 1));
            } else {
                pending = false;
                // restore default behavior at the end of scrolling sesh
                if (elem.$scrollBehavior != null) {
                    elem.style.scrollBehavior = elem.$scrollBehavior;
                    elem.$scrollBehavior = null;
                }
            }
        };

        // start a new queue of actions
        requestFrame(step, elem, 0);
        pending = true;
    }


    /***********************************************
     * EVENTS
     ***********************************************/

    /**
     * Mouse wheel handler.
     * @param {Object} event
     */
    function wheel(event) {

        if (!initDone) {
            init();
        }

        var target = event.target;

        // leave early if default action is prevented
        // or it's a zooming event with CTRL
        if (event.defaultPrevented || event.ctrlKey) {
            return true;
        }

        // leave embedded content alone (flash & pdf)
        if (isNodeName(activeElement, 'embed') ||
            (isNodeName(target, 'embed') && /\.pdf/i.test(target.src)) ||
            isNodeName(activeElement, 'object') ||
            target.shadowRoot) {
            return true;
        }

        var deltaX = -event.wheelDeltaX || event.deltaX || 0;
        var deltaY = -event.wheelDeltaY || event.deltaY || 0;

        if (isMac) {
            if (event.wheelDeltaX && isDivisible(event.wheelDeltaX, 120)) {
                deltaX = -120 * (event.wheelDeltaX / Math.abs(event.wheelDeltaX));
            }
            if (event.wheelDeltaY && isDivisible(event.wheelDeltaY, 120)) {
                deltaY = -120 * (event.wheelDeltaY / Math.abs(event.wheelDeltaY));
            }
        }

        // use wheelDelta if deltaX/Y is not available
        if (!deltaX && !deltaY) {
            deltaY = -event.wheelDelta || 0;
        }

        // line based scrolling (Firefox mostly)
        if (event.deltaMode === 1) {
            deltaX *= 40;
            deltaY *= 40;
        }

        var overflowing = overflowingAncestor(target);

        // nothing to do if there's no element that's scrollable
        if (!overflowing) {
            // except Chrome iframes seem to eat wheel events, which we need to
            // propagate up, if the iframe has nothing overflowing to scroll
            if (isFrame && isChrome) {
                // change target to iframe element itself for the parent frame
                Object.defineProperty(event, "target", { value: window.frameElement });
                return parent.wheel(event);
            }
            return true;
        }

        // check if it's a touchpad scroll that should be ignored
        if (isTouchpad(deltaY)) {
            return true;
        }

        // scale by step size
        // delta is 120 most of the time
        // synaptics seems to send 1 sometimes
        if (Math.abs(deltaX) > 1.2) {
            deltaX *= options.stepSize / 120;
        }
        if (Math.abs(deltaY) > 1.2) {
            deltaY *= options.stepSize / 120;
        }

        scrollArray(overflowing, deltaX, deltaY);
        event.preventDefault();
        scheduleClearCache();
    }

    /**
     * Keydown event handler.
     * @param {Object} event
     */
    function keydown(event) {

        var target = event.target;
        var modifier = event.ctrlKey || event.altKey || event.metaKey ||
            (event.shiftKey && event.keyCode !== key.spacebar);

        // our own tracked active element could've been removed from the DOM
        if (!document.body.contains(activeElement)) {
            activeElement = document.activeElement;
        }

        // do nothing if user is editing text
        // or using a modifier key (except shift)
        // or in a dropdown
        // or inside interactive elements
        var inputNodeNames = /^(textarea|select|embed|object)$/i;
        var buttonTypes = /^(button|submit|radio|checkbox|file|color|image)$/i;
        if (event.defaultPrevented ||
            inputNodeNames.test(target.nodeName) ||
            isNodeName(target, 'input') && !buttonTypes.test(target.type) ||
            isNodeName(activeElement, 'video') ||
            isInsideYoutubeVideo(event) ||
            target.isContentEditable ||
            modifier) {
            return true;
        }

        // [spacebar] should trigger button press, leave it alone
        if ((isNodeName(target, 'button') ||
            isNodeName(target, 'input') && buttonTypes.test(target.type)) &&
            event.keyCode === key.spacebar) {
            return true;
        }

        // [arrwow keys] on radio buttons should be left alone
        if (isNodeName(target, 'input') && target.type == 'radio' &&
            arrowKeys[event.keyCode]) {
            return true;
        }

        var shift, x = 0, y = 0;
        var overflowing = overflowingAncestor(activeElement);

        if (!overflowing) {
            // Chrome iframes seem to eat key events, which we need to
            // propagate up, if the iframe has nothing overflowing to scroll
            return (isFrame && isChrome) ? parent.keydown(event) : true;
        }

        var clientHeight = overflowing.clientHeight;

        if (overflowing == document.body) {
            clientHeight = window.innerHeight;
        }

        switch (event.keyCode) {
            case key.up:
                y = -options.arrowScroll;
                break;
            case key.down:
                y = options.arrowScroll;
                break;
            case key.spacebar: // (+ shift)
                shift = event.shiftKey ? 1 : -1;
                y = -shift * clientHeight * 0.9;
                break;
            case key.pageup:
                y = -clientHeight * 0.9;
                break;
            case key.pagedown:
                y = clientHeight * 0.9;
                break;
            case key.home:
                if (overflowing == document.body && document.scrollingElement)
                    overflowing = document.scrollingElement;
                y = -overflowing.scrollTop;
                break;
            case key.end:
                var scroll = overflowing.scrollHeight - overflowing.scrollTop;
                var scrollRemaining = scroll - clientHeight;
                y = (scrollRemaining > 0) ? scrollRemaining + 10 : 0;
                break;
            case key.left:
                x = -options.arrowScroll;
                break;
            case key.right:
                x = options.arrowScroll;
                break;
            default:
                return true; // a key we don't care about
        }

        scrollArray(overflowing, x, y);
        event.preventDefault();
        scheduleClearCache();
    }

    /**
     * Mousedown event only for updating activeElement
     */
    function mousedown(event) {
        activeElement = event.target;
    }


    /***********************************************
     * OVERFLOW
     ***********************************************/

    var uniqueID = (function () {
        var i = 0;
        return function (el) {
            return el.uniqueID || (el.uniqueID = i++);
        };
    })();

    var cacheX = {}; // cleared out after a scrolling session
    var cacheY = {}; // cleared out after a scrolling session
    var clearCacheTimer;
    var smoothBehaviorForElement = {};

    //setInterval(function () { cache = {}; }, 10 * 1000);

    function scheduleClearCache() {
        clearTimeout(clearCacheTimer);
        clearCacheTimer = setInterval(function () {
            cacheX = cacheY = smoothBehaviorForElement = {};
        }, 1 * 1000);
    }

    function setCache(elems, overflowing, x) {
        var cache = x ? cacheX : cacheY;
        for (var i = elems.length; i--;)
            cache[uniqueID(elems[i])] = overflowing;
        return overflowing;
    }

    function getCache(el, x) {
        return (x ? cacheX : cacheY)[uniqueID(el)];
    }

    //  (body)                (root)
    //         | hidden | visible | scroll |  auto  |
    // hidden  |   no   |    no   |   YES  |   YES  |
    // visible |   no   |   YES   |   YES  |   YES  |
    // scroll  |   no   |   YES   |   YES  |   YES  |
    // auto    |   no   |   YES   |   YES  |   YES  |

    function overflowingAncestor(el) {
        var elems = [];
        var body = document.body;
        var rootScrollHeight = root.scrollHeight;
        do {
            var cached = getCache(el, false);
            if (cached) {
                return setCache(elems, cached);
            }
            elems.push(el);
            if (rootScrollHeight === el.scrollHeight) {
                var topOverflowsNotHidden = overflowNotHidden(root) && overflowNotHidden(body);
                var isOverflowCSS = topOverflowsNotHidden || overflowAutoOrScroll(root);
                if (isFrame && isContentOverflowing(root) ||
                    !isFrame && isOverflowCSS) {
                    return setCache(elems, getScrollRoot());
                }
            } else if (isContentOverflowing(el) && overflowAutoOrScroll(el)) {
                return setCache(elems, el);
            }
        } while ((el = el.parentElement));
    }

    function isContentOverflowing(el) {
        return (el.clientHeight + 10 < el.scrollHeight);
    }

    // typically for <body> and <html>
    function overflowNotHidden(el) {
        var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
        return (overflow !== 'hidden');
    }

    // for all other elements
    function overflowAutoOrScroll(el) {
        var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
        return (overflow === 'scroll' || overflow === 'auto');
    }

    // for all other elements
    function isScrollBehaviorSmooth(el) {
        var id = uniqueID(el);
        if (smoothBehaviorForElement[id] == null) {
            var scrollBehavior = getComputedStyle(el, '')['scroll-behavior'];
            smoothBehaviorForElement[id] = ('smooth' == scrollBehavior);
        }
        return smoothBehaviorForElement[id];
    }


    /***********************************************
     * HELPERS
     ***********************************************/

    function addEvent(type, fn, arg) {
        window.addEventListener(type, fn, arg || false);
    }

    function removeEvent(type, fn, arg) {
        window.removeEventListener(type, fn, arg || false);
    }

    function isNodeName(el, tag) {
        return el && (el.nodeName || '').toLowerCase() === tag.toLowerCase();
    }

    function directionCheck(x, y) {
        x = (x > 0) ? 1 : -1;
        y = (y > 0) ? 1 : -1;
        if (direction.x !== x || direction.y !== y) {
            direction.x = x;
            direction.y = y;
            que = [];
            lastScroll = 0;
        }
    }

    if (window.localStorage && localStorage.SS_deltaBuffer) {
        try { // #46 Safari throws in private browsing for localStorage
            deltaBuffer = localStorage.SS_deltaBuffer.split(',');
        } catch (e) { }
    }

    function isTouchpad(deltaY) {
        if (!deltaY) return;
        if (!deltaBuffer.length) {
            deltaBuffer = [deltaY, deltaY, deltaY];
        }
        deltaY = Math.abs(deltaY);
        deltaBuffer.push(deltaY);
        deltaBuffer.shift();
        clearTimeout(deltaBufferTimer);
        deltaBufferTimer = setTimeout(function () {
            try { // #46 Safari throws in private browsing for localStorage
                localStorage.SS_deltaBuffer = deltaBuffer.join(',');
            } catch (e) { }
        }, 1000);
        var dpiScaledWheelDelta = deltaY > 120 && allDeltasDivisableBy(deltaY); // win64
        var tp = !allDeltasDivisableBy(120) && !allDeltasDivisableBy(100) && !dpiScaledWheelDelta;
        if (deltaY < 50) return true;
        return tp;
    }

    function isDivisible(n, divisor) {
        return (Math.floor(n / divisor) == n / divisor);
    }

    function allDeltasDivisableBy(divisor) {
        return (isDivisible(deltaBuffer[0], divisor) &&
            isDivisible(deltaBuffer[1], divisor) &&
            isDivisible(deltaBuffer[2], divisor));
    }

    function isInsideYoutubeVideo(event) {
        var elem = event.target;
        var isControl = false;
        if (document.URL.indexOf('www.youtube.com/watch') != -1) {
            do {
                isControl = (elem.classList &&
                    elem.classList.contains('html5-video-controls'));
                if (isControl) break;
            } while ((elem = elem.parentNode));
        }
        return isControl;
    }

    var requestFrame = (function () {
        return (window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            function (callback, element, delay) {
                window.setTimeout(callback, delay || (1000 / 60));
            });
    })();

    var MutationObserver = (window.MutationObserver ||
        window.WebKitMutationObserver ||
        window.MozMutationObserver);

    var getScrollRoot = (function () {
        var SCROLL_ROOT = document.scrollingElement;
        return function () {
            if (!SCROLL_ROOT) {
                var dummy = document.createElement('div');
                dummy.style.cssText = 'height:10000px;width:1px;';
                document.body.appendChild(dummy);
                var bodyScrollTop = document.body.scrollTop;
                var docElScrollTop = document.documentElement.scrollTop;
                window.scrollBy(0, 3);
                if (document.body.scrollTop != bodyScrollTop)
                    (SCROLL_ROOT = document.body);
                else
                    (SCROLL_ROOT = document.documentElement);
                window.scrollBy(0, -3);
                document.body.removeChild(dummy);
            }
            return SCROLL_ROOT;
        };
    })();


    /***********************************************
     * PULSE (by Michael Herf)
     ***********************************************/

    /**
     * Viscous fluid with a pulse for part and decay for the rest.
     * - Applies a fixed force over an interval (a damped acceleration), and
     * - Lets the exponential bleed away the velocity over a longer interval
     * - Michael Herf, http://stereopsis.com/stopping/
     */
    function pulse_(x) {
        var val, start, expx;
        // test
        x = x * options.pulseScale;
        if (x < 1) { // acceleartion
            val = x - (1 - Math.exp(-x));
        } else {     // tail
            // the previous animation ended here:
            start = Math.exp(-1);
            // simple viscous drag
            x -= 1;
            expx = 1 - Math.exp(-x);
            val = start + (expx * (1 - start));
        }
        return val * options.pulseNormalize;
    }

    function pulse(x) {
        if (x >= 1) return 1;
        if (x <= 0) return 0;

        if (options.pulseNormalize == 1) {
            options.pulseNormalize /= pulse_(1);
        }
        return pulse_(x);
    }


    /***********************************************
     * FIRST RUN
     ***********************************************/

    var userAgent = window.navigator.userAgent;
    var isEdge = /Edge/.test(userAgent); // thank you MS
    var isChrome = /chrome/i.test(userAgent) && !isEdge;
    var isSafari = /safari/i.test(userAgent) && !isEdge;
    var isMobile = /mobile/i.test(userAgent);
    var isIEWin7 = /Windows NT 6.1/i.test(userAgent) && /rv:11/i.test(userAgent);
    var isOldSafari = isSafari && (/Version\/8/i.test(userAgent) || /Version\/9/i.test(userAgent));
    var isEnabledForBrowser = (isChrome || isSafari || isIEWin7) && !isMobile;

    var supportsPassive = false;
    try {
        window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
            get: function () {
                supportsPassive = true;
            }
        }));
    } catch (e) { }

    var wheelOpt = supportsPassive ? { passive: false } : false;
    var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

    if (wheelEvent && isEnabledForBrowser) {
        addEvent(wheelEvent, wheel, wheelOpt);
        addEvent('mousedown', mousedown);
        addEvent('load', init);
    }


    /***********************************************
     * PUBLIC INTERFACE
     ***********************************************/

    function SmoothScroll(optionsToSet) {
        for (var key in optionsToSet)
            if (defaultOptions.hasOwnProperty(key))
                options[key] = optionsToSet[key];
    }
    SmoothScroll.destroy = cleanup;

    if (window.SmoothScrollOptions) // async API
        SmoothScroll(window.SmoothScrollOptions);

    if (typeof define === 'function' && define.amd)
        define(function () {
            return SmoothScroll;
        });
    else if ('object' == typeof exports)
        module.exports = SmoothScroll;
    else
        window.SmoothScroll = SmoothScroll;

})();


SmoothScroll({ stepSize: 40 })


$(window).on('load', function () {
    var tabs = $('.comparecartabsbar');
    var selector = $('.comparecartabsbar').find('a').length;
    var activeItem = tabs.find('.active');
    var activeWidth = activeItem.innerWidth();
    var activeItemPos = activeItem.position();
    $('.comparecartabsbar').find(".selector").css({
        "left": "0px",
        "width": activeWidth + "px"
    });


    var tablewrapper = $('.table-wrapper');
    var tablerow = $('.table-wrapper .tablerow');


    tablerow.each(function () {
        var mainthis = $(this);
        var tablerowwidth = mainthis.outerWidth(true);
        var tableeachcolwidth = ((tablerowwidth / 4) - 10);
        mainthis.find('.stickycol').css('width', tableeachcolwidth + 'px');
        mainthis.find('.tableinnercols').find('.tablecol').each(function () {
            $(this).css('width', tableeachcolwidth + 'px')
        })
    })

    function isInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)

        );
    }

    const box = document.querySelectorAll('.accordiantitle');

    $('.accordiantitle').on('click', function () {
        $(this).removeClass('sticky');
        $(this).toggleClass('active');
        $(this).parent('.eachaccordian').find('.accordiancontent').toggleClass('active');
    });

    $('.comparecartabsbar a').on('click', function (e) {
        e.preventDefault();
        var scrolltoaccord = $(this).attr('data-scrolltoaccordion');
        var scrollOffset = 115;

        var targetOffset = $('.eachaccordian[data-accordsection="' + scrolltoaccord + '"]').offset().top - scrollOffset;

        $('html, body').animate({
            scrollTop: targetOffset
        }, 700);

        $('.eachaccordian[data-accordsection="' + scrolltoaccord + '"]').find('.accordiancontent').addClass('active');
        $('.comparecartabsbar a').removeClass("active");
        $(this).addClass('active');

        var activeWidth = $(this).innerWidth();
        var itemPos = $(this).position();
        $(".selector").css({
            "left": itemPos.left + "px",
            "width": activeWidth + "px"
        });
    });




    $('.filtersubmit').on('click', function () {
        $('.stickycol').parent().hide();
        $('.scrollcars').parent().fadeIn();
        $('.filterselection').parent().find('input:checked').each(function () {
            const selectedText = $(this).parent().find('.text').text();
            $('.stickycol').each(function () {
                if ($(this).find('.compareheading').text() === selectedText) {
                    $(this).parent().fadeIn();
                }
            })
        })
    });

    $('.filterreset').on('click', function () {
        $('.stickycol').parent().fadeIn();
        $('.filterselection').parent().find('input:checked').each(function () {
            $(this).trigger('click');
        });
    })

    //greenhighlight
    $('.greenhightcomaprision').on('click', function () {
        if ($(this).find('input').is(':checked')) {
            $(this).find('input').prop('checked', false);
            $(this).removeClass('active');
            $('.comparecaraccordians .tableinnercols').each(function (index) {
                $(this).removeClass('greenhighlight');
            })
        } else {
            $(this).find('input').prop('checked', true);
            $(this).addClass('active');
            $('.comparecaraccordians .tableinnercols').each(function (index) {
                if ($(this).children().eq(1).text() && $(this).children().eq(0).text() != $(this).children().eq(1).text()) {
                    $(this).addClass('greenhighlight');
                } else if ($(this).children().eq(2).text() && $(this).children().eq(0).text() != $(this).children().eq(2).text()) {
                    $(this).addClass('greenhighlight');
                } else if ($(this).children().eq(3).text() && $(this).children().eq(0).text() != $(this).children().eq(3).text()) {
                    $(this).addClass('greenhighlight');
                } else if ($(this).children().eq(4).text() && $(this).children().eq(0).text() != $(this).children().eq(4).text()) {
                    $(this).addClass('greenhighlight');
                } else if ($(this).children().eq(5).text() && $(this).children().eq(0).text() != $(this).children().eq(5).text()) {
                    $(this).addClass('greenhighlight');
                }
            })
        }
    })

    $('.checkmark.hightlighteddifferencecheck').on('click', function () {
        if ($(this).hasClass('checked-differencehighlight')) {
            $(this).removeClass('checked-differencehighlight');
            $('.comparecaraccordians .tableinnercols').each(function (index) {
                $(this).removeClass('greenhighlight');
            })
        } else {
            $(this).addClass('checked-differencehighlight');

            $('.comparecaraccordians .tableinnercols').each(function (index) {
                if ($(this).children().eq(0).text() != $(this).children().eq(1).text() && $(this).children().eq(0).text() != '-' && $(this).children().eq(1).text() != '-') {
                    $(this).addClass('greenhighlight');
                } else if ($(this).children().eq(0).text() != $(this).children().eq(2).text() && $(this).children().eq(0).text() != '-' && $(this).children().eq(2).text() != '-') {
                    $(this).addClass('greenhighlight');
                } else if ($(this).children().eq(0).text() != $(this).children().eq(3).text() && $(this).children().eq(0).text() != '-' && $(this).children().eq(3).text() != '-') {
                    $(this).addClass('greenhighlight');
                } else if ($(this).children().eq(0).text() != $(this).children().eq(4).text() && $(this).children().eq(0).text() != '-' && $(this).children().eq(4).text() != '-') {
                    $(this).addClass('greenhighlight');
                } else if ($(this).children().eq(0).text() != $(this).children().eq(5).text() && $(this).children().eq(0).text() != '-' && $(this).children().eq(5).text() != '-') {
                    $(this).addClass('greenhighlight');
                }
            })
        }
    });

    //greenhighlight show only
    $('.checkmark.hightlightedcheck').on('click', function () {
        if ($(this).hasClass('checked-highlight')) {
            $(this).removeClass('checked-highlight');
            $('.comparecaraccordians .tableinnercols').each(function (index) {
                $(this).not('.greenhighlight').parent().fadeIn();
            })
        } else {
            $(this).addClass('checked-highlight');
            $('.comparecaraccordians .tableinnercols').each(function (index) {
                $(this).not('.greenhighlight').parent().hide()
            })
        }
    });

    $('#vehicle-detail-loading').on('load', function () {

    })

    //Save Comparision script start
    $('#savecomparisions').on('click', function () {
        $('#savecomparisionsmodal').modal('toggle');
    })

    $('#storesavedcomparisions').on('click', function () {
        $('#savecomparisions').text('Saved');
        $('#savecomparisions').css('background', '#fff').css('color', '#86C440').attr('disabled', 'disabled');
        $('#savecomparisionsmodal').modal('toggle');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (getQueryParam('comparisions')) {
            var save_comparisions = GetComparisionsDataFromLocalStorage();
        } else {
            var save_comparisions = GetDataFromLocalStorage(true);
        }

        $.post(save_compare_url, { vehicle_ids: save_comparisions }, function (result) {
        });
    })

    $('#storesavedcomparisionAndReset').on('click', function () {
        var save_comparisions;

        $('#savecomparisions').text('Saved');
        $(this).text('Saved');
        $(this).css('background', '#fff').css('color', '#86C440').attr('disabled', 'disabled');
        $('#savecomparisions').css('background', '#fff').css('color', '#86C440').attr('disabled', 'disabled');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (getQueryParam('comparisions')) {
            save_comparisions = GetComparisionsDataFromLocalStorage();
        } else {
            save_comparisions = GetDataFromLocalStorage(true);
        }

        $.post(save_compare_url, { vehicle_ids: save_comparisions }, function (result) {
        });
    });

    //Save Comparision script end

    $('#reset-all-comparisions').on('click', function () {
        $('#reset-comparision-confirmation').modal('toggle');
    })

    $('#reset-all-comparisions-yes').on('click', function () {
        $('.vehicledelete').trigger('click');
        $('#reset-comparision-confirmation').modal('toggle');
        $('.resetfiltersettings').hide();
        window.scrollTo({ top: 50, behavior: 'smooth' });
        $('#savecomparisions').removeAttr('disabled').removeAttr('style').text('Save');
        $('.total-comparisions').html(0);
        if (getQueryParam('comparisions')) {
            DeleteAllComparisionsVehiclesDataFromLocalStorage(); //deleting comparisions from localstorage

        } else {
            DeleteAllVehiclesDataFromLocalStorage(); //deleting comparisions from localstorage
        }

    });

    $('.newcarselectoroption').select2()
        .on('change', function (e) {
            console.log($(".firstcomparision").is(":hidden"))
        });


    $('.select-vehicle').on('click', function () {

        const $children = $(".dragableslidingcars").children();
        if ($children.filter(":hidden").length === 0) {
            alert("Max cars have been reached. Remove a car or start a new comparison to continue.");
        }
        let carShown = false;

        // Loop through each child and find the first hidden one to show
        $children.each(function (index) {
            if ($(this).is(":hidden")) {
                $(this).fadeIn(1000);  // Smoothly show the hidden car
                carShown = true;
                return false;  // Exit the loop after showing one car
            }
        });
        console.log($children.filter(":hidden").length, carShown)
        // If all visible and max cars have been reached, trigger the next slide
        if (carShown && $children.filter(":hidden").length === 2) {
            $('.next.next1').trigger('click');
            // Check for any remaining hidden cars after sliding
            // $children.each(function (index) {
            //     if ($(this).is(":hidden")) {
            //         $(this).fadeIn(1000);  // Smoothly show the next hidden car
            //         return false;  // Exit the loop after showing one car
            //     }
            // });
        }

        // If no cars are hidden at all, show the alert

    });


    $('.horsepowermeter').each(function () {
        var mainthis = $(this);
        var meterPercentValue = mainthis.attr('data-metervalue');
        mainthis.find('.overlaymeter').css('width', meterPercentValue + '%');
        mainthis.find('.valueholder').css('width', meterPercentValue + '%');
    });


    function updateSlider() {
        let isMobile = window.innerWidth <= 768; // Define mobile screen width threshold
        let cardsToShow = isMobile ? 1 : 3;
        // Reset all cards to be visible and then hide the necessary ones
        $('.dragableslidingcars .carcard').removeClass('hide');
        $('.dragableslidingcars .carcard').slice(cardsToShow).addClass('hide');

        $('.carslidernavigation .prev').addClass('disabled');
        if ($('.dragableslidingcars .carcard').length <= cardsToShow) {
            $('.carslidernavigation .next').addClass('disabled');
        } else {
            $('.carslidernavigation .next').removeClass('disabled');
        }

        // Next button click event
        $('.carslidernavigation .next').off('click').on('click', function () {
            let cards = $('.dragableslidingcars .carcard');
            let firstVisible = cards.index(cards.not('.hide').first());
            let lastVisible = cards.index(cards.not('.hide').last());

            if (lastVisible + 1 < cards.length) {
                cards.slice(firstVisible, firstVisible + cardsToShow).addClass('hide');
                cards.slice(lastVisible + 1, lastVisible + 1 + cardsToShow).removeClass('hide');
            }

            if (lastVisible + cardsToShow >= cards.length - 1) {
                $('.carslidernavigation .next').addClass('disabled');
            } else {
                $('.carslidernavigation .next').removeClass('disabled');
            }

            $('.carslidernavigation .prev').removeClass('disabled');
        });

        // Previous button click event
        $('.carslidernavigation .prev').off('click').on('click', function () {
            let cards = $('.dragableslidingcars .carcard');
            let firstVisible = cards.index(cards.not('.hide').first());
            let lastVisible = cards.index(cards.not('.hide').last());

            if (firstVisible > 0) {
                cards.slice(lastVisible - cardsToShow + 1, lastVisible + 1).addClass('hide');
                cards.slice(firstVisible - cardsToShow, firstVisible).removeClass('hide');
            }

            if (firstVisible - cardsToShow <= 0) {
                $('.carslidernavigation .prev').addClass('disabled');
            } else {
                $('.carslidernavigation .prev').removeClass('disabled');
            }

            $('.carslidernavigation .next').removeClass('disabled');
        });

        $(window).resize(function () {
            updateSlider();
        });
    }

    updateSlider();

    // Function to update slider navigation based on current state

    $('[data-toggle="tooltip"]').tooltip();

});

var carsTitlesBar = document.querySelector('.carcomparisionlists');
var d1 = document.querySelectorAll(".carlistscroller");


function OnScroll(div) {
    d1.forEach(function (ele) {
        ele.scrollLeft = div.scrollLeft;
    });
}

d1.forEach(function (ele) {
    ele.addEventListener('scroll', function () {
        carsTitlesBar.scrollLeft = ele.scrollLeft;
    });
});

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    if ($('#myDropdown').hasClass("show")) {
        $('#toggleArrow').html('<i class="fa fa-angle-up"></i>')
    } else {
        $('#toggleArrow').html('<i class="fa fa-angle-down"></i>')
    }
}

/*function SaveDataToLocalStorage(vehicle) {
    var a = [];
    a = JSON.parse(localStorage.getItem('comparisions')) || [];
    let exists = Object.values(a).includes(vehicle);
    if (!exists) {
        a.push(vehicle);
        localStorage.setItem('comparisions', JSON.stringify(a));
        $('.total-comparisions').html(a.length);
    }
    console.log(a);
}*/

function SaveDataToLocalStorage(vehicle, rankTag) {
    // Retrieve the existing comparisons from localStorage, or initialize an empty object
    var comparisions = JSON.parse(localStorage.getItem('comparisions')) || {};

    // Check if there are fewer than 6 cars stored already
    if (Object.keys(comparisions).length < 6) {
        // Store the vehicle object with the rank as the key (e.g., "1st", "2nd")
        comparisions[rankTag] = vehicle;

        // Save the updated object back to localStorage
        localStorage.setItem('comparisions', JSON.stringify(comparisions));
        // Update the UI with the total number of comparisons
        var totalComparisons = Object.keys(comparisions).length;
        $('.main-total-comparisions').text(totalComparisons + (totalComparisons === 1 ? ' Car Added' : ' Cars Added'));
        $('.total-comparisions').text(totalComparisons);
    } else {
        console.log('You can only add up to 6 cars.');
    }

}



function SaveDataToLocalStorageWithoutKey(vehicle) {
    var comparisions = JSON.parse(localStorage.getItem('comparisions')) || {};
    local_data = GetDataFromLocalStorage(true)
    // Check if the index is valid
    if (Object.keys(local_data).length + 1 <= 6) {
        comparisions[getNumberWithOrdinal(Object.keys(local_data).length + 1)] = vehicle.toString();
        localStorage.setItem('comparisions', JSON.stringify(comparisions));
        $('.total-comparisions').html(Object.keys(JSON.parse(localStorage.getItem('comparisions'))).length);
    } else {
        alert('Max cars have been reached and to remove a car or start a new comparison to continue.');
    }

    // console.log(JSON.parse(localStorage.getItem('comparisions')));
}

function isVehicleIDInComparisons(comparisons, vehicleID) {
    return Object.values(comparisons).includes(vehicleID);
}

function deletePropertyByValue(object, value) {

    var keyToDelete = Object.keys(object).find(key => object[key] === value);
    delete object[keyToDelete];

    var totalComparisons = Object.keys(object).length;
    $('.total-comparisions').text(totalComparisons);

    var newComparisons = {};
    var keys = Object.keys(object);
    for (var i = 0; i < keys.length; i++) {
        var newKey = (i + 1) + (i === 0 ? 'st' : i === 1 ? 'nd' : i === 2 ? 'rd' : 'th');
        newComparisons[newKey] = object[keys[i]];
    }

    localStorage.setItem('comparisions', JSON.stringify(newComparisons));
}


function SaveComparisionsDataToLocalStorage(vehicle, key) {
    // Retrieve the existing 'query_comparisions' data from localStorage or initialize it as an empty object
    var comparisions = JSON.parse(localStorage.getItem('query_comparisions')) || {};

    // Check if the number of stored comparisons is less than or equal to 6
    if (Object.keys(comparisions).length < 6) {
        // Save the full vehicle object using the rank (key) as the identifier
        comparisions[key] = vehicle;

        // Update localStorage with the new comparison data
        localStorage.setItem('query_comparisions', JSON.stringify(comparisions));

        // Update the total comparisons shown in the UI
        $('.total-comparisions').html(Object.keys(comparisions).length);
    } else {
        // Limit reached: only 6 cars can be added
        console.log('Invalid index. Please provide an index between 1 and 6.');
    }

    // For debugging, log the current localStorage content to the console
}


function DeleteComparisionsDataFromLocalStorage(key) {
    var comparisions = JSON.parse(localStorage.getItem('query_comparisions')) || {};

    if (Object.keys(comparisions).length > 0) {
        if (comparisions.hasOwnProperty(key)) {
            delete comparisions[key];
            localStorage.setItem('query_comparisions', JSON.stringify(comparisions));
            var totalComparisons = Object.keys(comparisions).length;
            alert(totalComparisons)
            $('.total-comparisions').text(totalComparisons + (totalComparisons === 1 ? ' Car' : ' Cars'));
        } else {
            console.log('Key does not exist. Unable to delete.');
        }
    } else {
        console.log('No cars to remove from comparison.');
    }
}


function UpdateKeysInLocalStorage() {
    var comparisons = JSON.parse(localStorage.getItem('comparisons')) || {};
    var keys = Object.keys(comparisons);
    var newComparisons = {};
    // for (var i = 0; i < keys.length; i++) {
    //     if(i == 0){
    //         var newKey = '1st';
    //     } else if(i == 1){
    //         var newKey = '2nd';
    //     } else if(i == 2){
    //         var newKey = '3rd';
    //     } else if(i == 3){
    //         var newKey = '4th';
    //     } else if(i == 4){
    //         var newKey = '5th';
    //     } else if(i == 5){
    //         var newKey = '6th';
    //     }
    //     newComparisons[newKey] = comparisons[keys[i]];
    // }
    // localStorage.setItem('comparisons', JSON.stringify(newComparisons));
}

function GetDataFromLocalStorage(saved = false) {
    if (!saved) {
        DeleteAllComparisionsVehiclesDataFromLocalStorage();
    }

    data = [];
    if (localStorage.getItem('comparisions')) {
        data = JSON.parse(localStorage.getItem('comparisions'))
    }
    return data
}

function GetComparisionsDataFromLocalStorage() {
    return JSON.parse(localStorage.getItem('query_comparisions'))
}

function DeleteAllVehiclesDataFromLocalStorage() {
    localStorage.removeItem('comparisions');
    $('.total-comparisions').html(0);
}

function DeleteAllComparisionsVehiclesDataFromLocalStorage() {
    localStorage.removeItem('query_comparisions');
    $('.total-comparisions').html(0);
}
function getNumberWithOrdinal(n) {
    var s = ["th", "st", "nd", "rd"],
        v = n % 100;
    return n + (s[(v - 20) % 10] || s[v] || s[0]);
}
function makeFavourite(vehicle_id, user_id) {
    if (!vehicle_id && !user_id) return false;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post(favourite_url, { vehicle_id: vehicle_id, user_id: user_id }, function (result) {
        if (result.success && result.success === 'Vehicle marked favourite successfully.') {
            $('#favourite-' + vehicle_id + ' ul li a.favourite-vehicle').css('color', 'red');
            $('#favourite-' + vehicle_id + ' a.favourite-vehicle i').css('color', 'red');
            $('.favourite-vehicle.detail').html('<img src="/frontend/assets/images/heart-icon-filled.png" alt="">');
        } else if (result.success && result.success === 'Vehicle removed from favourite successfully.') {
            $('#favourite-' + vehicle_id + ' ul li a.favourite-vehicle').css('color', '#fff');
            $('#favourite-' + vehicle_id + ' a.favourite-vehicle i').css('color', '#fff');
            $('.favourite-vehicle.detail').html('<img src="/frontend/assets/images/heart-icon.png" alt="">');
        }
    });
}

function getQueryParam(parameterName) {
    // Get the current URL
    var currentUrl = window.location.href;

    // Check if the URL has a query string
    if (currentUrl.indexOf('?') !== -1) {
        // Get the parameters from the query string
        var queryString = currentUrl.split('?')[1];

        // Split the query string into key-value pairs
        var keyValuePairs = queryString.split('&');

        // Loop through the key-value pairs
        for (var i = 0; i < keyValuePairs.length; i++) {
            var pair = keyValuePairs[i].split('=');
            var key = decodeURIComponent(pair[0]);
            var value = decodeURIComponent(pair[1] || '');

            // Check if the current key matches the parameterName
            if (key === parameterName) {
                // Return the value of the parameter
                return value;
            }
        }
    }

    // Return null if the parameter is not found
    return null;
}

// function priceWithCommas(x) {
//     return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
// }

function priceWithCommas(value) {
    // Round the number to the nearest whole number
    let roundedValue = Math.round(value);

    // Convert the number to an integer to remove the decimal part
    let intValue = parseInt(roundedValue);

    // Use toLocaleString with options to format as a price
    let formattedPrice = intValue.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

    // Remove ".00" from the formatted price
    formattedPrice = formattedPrice.replace(/\.00$/, '');

    return formattedPrice;
}



$(document).ready(function () {
    console.log($('.main-total-comparisons').length);
    $('.vehicledelete').on('click', function () {

        var currentState = $(this).parent().parent()
        $(".dragableslidingcars").append(currentState.parent().parent().hide());
        currentState.find('.title').text('-');
        currentState.prev().find('.vehicle-image').attr('src', siteurl + 'frontend/assets/images/comparision-placeholder.jpeg')
        currentState.parent().parent().find(".carselectoroption").val(0).trigger('change');
        $('#savecomparisions').removeAttr('disabled').removeAttr('style').text('Save');
        var rankTag = currentState.find('.ranktag').text();
        $.each($('.stickycol'), function () {
            if (rankTag == '1st') {
                $(this).next().children().eq(0).text('');
                $(this).next().append($(this).next().children().eq(0).remove());
            } else if (rankTag == '2nd') {
                $(this).next().children().eq(1).text('');
                $(this).next().append($(this).next().children().eq(1).remove());
            } else if (rankTag == '3rd') {
                $(this).next().children().eq(2).hide();
            } else if (rankTag == '4th') {
                $(this).next().children().eq(3).hide();
            } else if (rankTag == '5th') {
                $(this).next().children().eq(4).hide();
            } else if (rankTag == '6th') {
                $(this).next().children().eq(5).hide();
            }
        });

        const $children = $(".dragableslidingcars").children();
        if ($children.filter(":hidden").length === 3) {
            $('.prev.prev1').trigger('click');
        }

        DeleteDataFromLocalStorage(rankTag);


        //Update the ranking
        var draggablelist = document.querySelector('.dragableslidingcars');
        var draggablelistranktag = draggablelist.querySelectorAll('.ranktag');
        draggablelistranktag.forEach(function (elem, indexnum) {
            elem.innerHTML = getNumberWithOrdinal(indexnum + 1);
        })


    })

    function DeleteDataFromLocalStorage(key) {
        var comparisions = JSON.parse(localStorage.getItem('comparisions')) || {};
    
        if (Object.keys(comparisions).length <= 6) {
            if (comparisions.hasOwnProperty(key)) {
                delete comparisions[key];
                localStorage.setItem('comparisions', JSON.stringify(comparisions));
    
                // Re-index the keys
                const newComparisons = {};
                let index = 1;
                for (const [rank, value] of Object.entries(comparisions)) {
                    newComparisons[getNumberWithOrdinal(index)] = value;
                    index++;
                }
                localStorage.setItem('comparisions', JSON.stringify(newComparisons));
    
                var totalComparisons = Object.keys(newComparisons).length;
                
                $('.main-total-comparisions').text(totalComparisons + (totalComparisons === 1 ? ' Car Added' : ' Cars Added'));
                $('.total-comparisions').text(totalComparisons);
            } else {
                console.log('Key does not exist. Unable to delete.');
            }
        } else {
            console.log('Invalid index. Please provide an index between 1 and 6.');
        }
    }

    $.ajax({
        url: baseURL + '/api/garage-vehicles',
        method: 'GET',
        dataType: 'json',
        success: function (garageVehicles) {
            // Initialize the select2 with AJAX search
            $('.carselectoroption').select2({
                ajax: {
                    url: baseURL + '/api/cars',
                    dataType: 'json',
                    delay: 200,
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        // Check if API search returned any items
                        if (data.items.length) {
                            return {
                                results: data.items.map(function (car) {
                                    return {
                                        id: car.id,
                                        text: car.name,
                                        image: car.image,
                                        data: car.data
                                    };
                                }),
                                pagination: {
                                    more: data.hasMore
                                }
                            };
                        } else {
                            // No search results, fall back to garage vehicles
                            return {
                                results: garageVehicles.map(function (car) {
                                    return {
                                        id: car.id,
                                        text: car.name + ' <i>(My Garage Item)</i>',
                                        image: car.image,
                                        data: car.data
                                    };
                                }),
                                pagination: {
                                    more: false
                                }
                            };
                        }
                    },
                    cache: true
                },
                escapeMarkup: function (markup) { return markup; },
                minimumInputLength: 0,
                placeholder: 'Search for a vehicle',
                allowClear: true
            })
                .on('change', function (e) {
                    const selectedData = $(this).select2('data');

                    if (selectedData.length > 0) {
                        const carData = selectedData[0];
                        const ID = carData.id;
                        const name = carData.text;
                        const carFullData = carData;

                        let currentState = $(this).parent().next();
                        if (name !== 'Select Vehicle') {
                            let vehicle_link = `<a href="${siteurl}vehicle/${ID}" target="_blank">${name.substring(0, 35)}${name.length > 35 ? '...' : ''}</a>`;
                            currentState.find('.title').html(vehicle_link);
                            currentState.find('.vehicleprofile').attr("onclick", `window.location.href='${siteurl}vehicle/${ID}'`);
                            currentState.find('.social-share-links a').eq(0).attr("onclick", `window.open('https://www.facebook.com/sharer/sharer.php?u=${siteurl}vehicle/${ID}')`);
                            currentState.find('.social-share-links a').eq(1).attr("onclick", `window.open('https://twitter.com/intent/tweet?url=${siteurl}vehicle/${ID}')`);
                            currentState.find('.social-share-links a').eq(2).attr("onclick", `window.open('mailto:?subject=Check%20out%20this%20vehicle&body=${siteurl}vehicle/${ID}')`);
                            currentState.find('.favourite-vehicle').attr("onclick", `makeFavourite('${ID}', '${auth_user_id}')`);
                            currentState.find('.favourite-vehicle').parent().attr("id", `favourite-${ID}`);
                        }

                        let rankTag = $(this).parent().next().find('.ranktag').text();
                        SaveDataToLocalStorage(carFullData, rankTag);
                        $('.resetfiltersettings').fadeIn();
                        $('.carcomparisionlists').css('visibility', 'visible');
                        $('.comaprisionblock').css('display', 'block');
                        $('#savecomparisions').removeAttr('disabled').removeAttr('style').text('Save');
                        currentState.find('.vehicledelete').attr('data-id', ID);

                        if (rankTag) {
                            currentState.find('.favourite-vehicle i').css('color', carFullData?.user?.length > 0 ? 'red' : '');
                            vehicleDetail(JSON.parse(carFullData.data), rankTag.slice(0, 1) - 1, currentState, name, ID, carFullData);
                        }

                        // Calculations for specifications
                        ['horse-power', 'rpm', 'torque', 'torque-rpm'].forEach(spec => {
                            let maxSpec = Math.max(...$(`.specifications-${spec}`).next().children().map(function () {
                                return parseInt($(this).find('.valueholder').text());
                            }).get());

                            $(`.specifications-${spec}`).next().children().each(function () {
                                let currentSpec = parseInt($(this).find('.valueholder').text());
                                $(this).find('.horsepowermeter').children().css('width', currentSpec >= maxSpec ? '100%' : `${(currentSpec * 100) / maxSpec}%`);
                            });
                        });
                    } else {
                        console.log('selectedData is either not an array or it is empty.');
                    }
                });
        },
        error: function () {
            console.error('Failed to fetch garage vehicles.');
        }
    });
    // Retrieve the comparison data from URL or localStorage
    const storedComparisons = localStorage.getItem('comparisions') ? JSON.parse(localStorage.getItem('comparisions')) : {};

    $('.total-comparisions').html(Object.keys(storedComparisons).length);

    // Initialize selectors with comparison data
    initializeComparisionSelectors(storedComparisons);

    function initializeComparisionSelectors(comparisons) {
        const selectors = ['.firstcomparision', '.secondcomparision', '.thirdcomparision', '.fourthcomparision', '.fifthcomparision', '.sixthcomparision'];
        // Loop through comparisons and map them to selectors
        Object.entries(comparisons).forEach(([rank, carObj], index) => {
            if (index < selectors.length) {
                const selector = selectors[index];

                $(selector).show(); // Fade-in animation

                // Create a new option for select2 and set it as selected
                const option = new Option(carObj.text, carObj.id, true, true);
                $(selector + ' .carselectoroption').append(option).trigger('change');

                // Display favorite icon based on user data
                $(selector).find('.favourite-vehicle i').css('color', carObj?.user?.length > 0 ? 'red' : '');

                // Show car details with slide-down animation
                $(selector).find('.car-details').slideDown(400);

                $('.resetfiltersettings').fadeIn();
                $('.carcomparisionlists').css('visibility', 'visible');
                $('.comaprisionblock').css('display', 'block');
                $('#savecomparisions').removeAttr('disabled').removeAttr('style').text('Save');
                $(selector).find('.vehicledelete').attr('data-id', carObj.id);

                // Display car details if data exists
                vehicleDetail(JSON.parse(carObj.data), index, $(selector), carObj.text, carObj.id, carObj);
            }
        });
    }

});


function vehicleDetail(vehicle, index, currentState, name, ID, data) {

    name = name.replace(/<\/?i>/g, '');

    $('.tableinnercols').each(function () {
        $(this).children().eq(index).fadeIn();
        $(this).children().eq(index).text('-');
    });
    if (name)
        $('.carcomparisionlists').children().eq(index).text(name);
    if (currentState) {

        currentState.find('.vehicle-image').css('cursor', 'pointer');
        currentState.find('.vehicle-image').on('click', function () {
            window.open(siteurl + 'vehicle/' + ID, '_blank');
        });
        currentState.find('.vehicle-image').attr('src', siteurl + 'frontend/assets/images/comparision-placeholder.jpeg');
        if (data?.image && (!data?.image.startsWith('http://'))) {
            currentState.find('.vehicle-image').attr('src', siteurl + data?.image);
        }
    }

    if (data.link_url)
        $('.stickycol.company-website').next().children().eq(index).html('<a target="_blank" href="' + data?.link_url + '">' + data?.link_url + '</a>');

    $('.stickycol.specifications-body').next().children().eq(index).text(data?.body_type);
    $('.stickycol.specifications-trim').next().children().eq(index).text(vehicle.style?.trim ?? vehicle.style?.nameWoTrim);
    $('.stickycol.specifications-cylinders').next().children().eq(index).text(vehicle.engine?.cylinders);
    $('.stickycol.specifications-drive-train').next().children().eq(index).text(vehicle.style?.drivetrain);
    $('.stickycol.specifications-fuel-economy-city').next().children().eq(index).text(vehicle.engine.fuelEconomy ? vehicle.engine.fuelEconomy?.city?.low : '-');
    $('.stickycol.specifications-fuel-economy-highway').next().children().eq(index).text(vehicle.engine.fuelEconomy ? vehicle.engine.fuelEconomy.hwy?.low : '-');
    $('.stickycol.specifications-fuelType').next().children().eq(index).text(data?.fuel_type?.name);
    $('.stickycol.specifications-engineType').next().children().eq(index).text(data?.engine_type?.name ?? vehicle?.engine?.engineType?._);
    // $('.stickycol.specifications-torque').next().children().eq(index).text(vehicle.engine?.netTorque?.value);
    $('.stickycol.specifications-size').next().children().eq(index).text(vehicle?.engine.fuelCapacity ? (vehicle?.engine?.fuelCapacity?.high + vehicle.engine?.fuelCapacity?.unit) : '-');
    $('.stickycol.specifications-stock-number').next().children().eq(index).text(vehicle?.style?.acode?._);
    $('.stickycol.specifications-displacements').next().children().eq(index).text(vehicle?.engine.length > 0 && vehicle.engine[0].displacement.value.length > 0 ? (vehicle.engine[0]?.displacement?.value[0]?._ + vehicle?.engine[0]?.displacement?.value[0]?.unit) : (vehicle?.engine.displacement ? (vehicle?.engine?.displacement?.value?._ + vehicle?.engine?.displacement?.value?.unit) : '-'));

    //horse power
    if (vehicle.engine.length > 0) {
        $('.stickycol.specifications-horse-power').next().children().eq(index).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">' + vehicle.engine[0].horsepower?.value + '</div></div>');
        $('.stickycol.specifications-horse-power').next().children().eq(index).find('.horsepowermeter').children().css('width', 100 + '%');
    } else if (vehicle.engine.horsepower.value) {
        $('.stickycol.specifications-horse-power').next().children().eq(index).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">' + vehicle.engine?.horsepower?.value + '</div></div>');
        $('.stickycol.specifications-horse-power').next().children().eq(index).find('.horsepowermeter').children().css('width', 100 + '%');
    }

    //RPM
    if (vehicle.engine.length > 0) {
        $('.stickycol.specifications-rpm').next().children().eq(index).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">' + vehicle.engine[0].horsepower?.rpm + '</div></div>');;
        $('.stickycol.specifications-rpm').next().children().eq(index).find('.horsepowermeter').children().css('width', 100 + '%');
    } else if (vehicle.engine.horsepower.rpm) {
        $('.stickycol.specifications-rpm').next().children().eq(index).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">' + vehicle.engine?.horsepower?.rpm + '</div></div>');;
        $('.stickycol.specifications-rpm').next().children().eq(index).find('.horsepowermeter').children().css('width', 100 + '%');
    } else {
        $('.stickycol.specifications-rpm').next().children().eq(index).html('<span>-</span>')
    }

    //net torque
    if (vehicle?.engine?.length > 0) {
        $('.stickycol.specifications-torque').next().children().eq(index).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">' + vehicle.engine[0].netTorque?.value + '</div></div>');;
        $('.stickycol.specifications-torque').next().children().eq(index).find('.horsepowermeter').children().css('width', 100 + '%');
    } else if (vehicle?.engine?.netTorque?.value) {
        $('.stickycol.specifications-torque').next().children().eq(index).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">' + vehicle.engine?.netTorque?.value + '</div></div>');;
        $('.stickycol.specifications-torque').next().children().eq(index).find('.horsepowermeter').children().css('width', 100 + '%');
    } else {
        $('.stickycol.specifications-torque').next().children().eq(index).html('<span>-</span>')
    }

    //net torque
    if (vehicle?.engine?.length > 0) {
        $('.stickycol.specifications-torque-rpm').next().children().eq(index).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">' + vehicle.engine[0].netTorque?.rpm + '</div></div>');;
        $('.stickycol.specifications-torque-rpm').next().children().eq(index).find('.horsepowermeter').children().css('width', 100 + '%');
    } else if (vehicle?.engine?.netTorque?.rpm) {
        $('.stickycol.specifications-torque-rpm').next().children().eq(index).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">' + vehicle.engine?.netTorque?.rpm + '</div></div>');;
        $('.stickycol.specifications-torque-rpm').next().children().eq(index).find('.horsepowermeter').children().css('width', 100 + '%');
    } else {
        $('.stickycol.specifications-torque-rpm').next().children().eq(index).html('<span>-</span>')
    }

    $('.stickycol.dimension-invoice').next().children().eq(index).text(priceWithCommas(vehicle?.basePrice?.invoice?.low) + ' / ' + priceWithCommas(vehicle?.basePrice?.msrp?.high));

    //Loop to get Generaic Equipment Definations
    if (vehicle?.genericEquipment) {
        for (let i = 0; i < vehicle.genericEquipment.length; i++) {
            if (Object.hasOwn(vehicle.genericEquipment[i], 'definition')) {
                if (Object.hasOwn(vehicle.genericEquipment[i].definition, 'category')) {
                    //List Down all properties
                    if (vehicle.genericEquipment[i].definition.category._ == 'Leather Seats')
                        $('.stickycol.seating-leather-seats').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Seat Memory')
                        $('.stickycol.seating-seat-memory').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Heated Front Seat(s)')
                        $('.stickycol.seating-heated-front-seats').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Heated Rear Seat(s)')
                        $('.stickycol.seating-heated-rear-seats').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Cooled Front Seat(s)')
                        $('.stickycol.seating-cooled-front-seats').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'AM/FM Stereo')
                        $('.stickycol.accessories-stereo').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Climate Control')
                        $('.stickycol.accessories-climate-control').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'A/C')
                        $('.stickycol.accessories-ac').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Security System')
                        $('.stickycol.accessories-security-system').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Cruise Control')
                        $('.stickycol.accessories-cruise-control').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Keyless Entry')
                        $('.stickycol.accessories-keyless-entry').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Power Door Locks')
                        $('.stickycol.accessories-power-door-locks').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Heated Mirrors')
                        $('.stickycol.accessories-heated-mirrors').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Sun/Moonroof')
                        $('.stickycol.accessories-sun-moonroof').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Intermittent Wipers')
                        $('.stickycol.accessories-intermittent-wipers').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'MP3 Player')
                        $('.stickycol.accessories-mp3').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Auto-Dimming Rearview Mirror')
                        $('.stickycol.accessories-auto-dimming-rearview-mirror').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Luggage Rack')
                        $('.stickycol.accessories-luggage-rack').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Bluetooth Connection')
                        $('.stickycol.accessories-bluetooth-connection').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Back-Up Camera')
                        $('.stickycol.accessories-back-up-camera').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Keyless Start')
                        $('.stickycol.accessories-keyless-start').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Lane Departure Warning')
                        $('.stickycol.accessories-lane-departure-warning').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Cruise Control Steering Assist')
                        $('.stickycol.accessories-cruise-control-steering-assist').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Smart Device Integration')
                        $('.stickycol.accessories-smart-device-integration').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Automatic Parking')
                        $('.stickycol.accessories-automatic-parking').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Hands-Free Liftgate')
                        $('.stickycol.accessories-power-liftgate').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Navigation System')
                        $('.stickycol.accessories-navigation-system').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Panoramic Roof')
                        $('.stickycol.accessories-panoramic-roof').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Heads-Up Display')
                        $('.stickycol.accessories-headsup-display').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Cruise Control Steering Assist')
                        $('.stickycol.accessories-accessories-cruise-control-assist').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if (vehicle.genericEquipment[i].definition.category._ == 'Adaptive Cruise Control')
                        $('.stickycol.accessories-cruise-control-adaptive').next().children().eq(index).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                }
            }
        }
    }


    //Loop to get Technical Specification Definations
    if (vehicle.technicalSpecification) {
        for (let i = 0; i < vehicle.technicalSpecification.length; i++) {
            if (Object.hasOwn(vehicle.technicalSpecification[i], 'definition')) {
                if (Object.hasOwn(vehicle.technicalSpecification[i].definition, 'title')) {
                    //List Down All properties
                    if (vehicle.technicalSpecification[i].definition.title._ == 'EPA Classification')
                        $('.stickycol.vehicle-epa-classification').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Passenger Capacity')
                        $('.stickycol.dimension-pasenger-capacity').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Front Head Room')
                        $('.stickycol.dimension-front-head-room').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Front Leg Room')
                        $('.stickycol.dimension-front-leg-room').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Front Shoulder Room')
                        $('.stickycol.dimension-front-shoulder-room').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Front Hip Room')
                        $('.stickycol.seating-front-hip-room').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Second Head Room')
                        $('.stickycol.seating-second-head-room').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Second Leg Room')
                        $('.stickycol.seating-second-leg-room').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Second Shoulder Room')
                        $('.stickycol.seating-second-shoulder-room').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Second Hip Room')
                        $('.stickycol.seating-second-hip-room').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Length, Overall')
                        $('.stickycol.seating-length').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Width, Max w/o mirrors')
                        $('.stickycol.seating-width').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Height, Overall')
                        $('.stickycol.seating-height').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Track Width, Front')
                        $('.stickycol.seating-track-width-front').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Track Width, Rear')
                        $('.stickycol.seating-track-width-rear').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Min Ground Clearance')
                        $('.stickycol.seating-ground-clearance').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Payload Capacity')
                        $('.stickycol.seating-payload-capacity').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Cargo Volume to Seat 1')
                        $('.stickycol.seating-cargo-volume').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Cargo Volume to Seat 2')
                        $('.stickycol.seating-cargo-volume-trunk').next().children().eq(index).text(vehicle.technicalSpecification[i].range.max);

                    //Chassis
                    if (vehicle.technicalSpecification[i].definition.title._ == 'Base Curb Weight')
                        $('.stickycol.seating-curb-weight').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Dead Weight Hitch - Max Trailer Wt.')
                        $('.stickycol.chasis-dead-max-trailor').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Dead Weight Hitch - Max Tongue Wt.')
                        $('.stickycol.chasis-dead-max-tongue').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Wt Distributing Hitch - Max Trailer Wt')
                        $('.stickycol.chasis-wt-max-trailor').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Wt Distributing Hitch - Max Tongue Wt.')
                        $('.stickycol.chasis-wt-max-tongue').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Fuel Tank Capacity')
                        $('.stickycol.fuel-tank-capacity').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);

                    if (vehicle.technicalSpecification[i].definition.title._ == 'Estimated Battery Range')
                        $('.stickycol.specifications-battery-range').next().children().eq(index).text(vehicle.technicalSpecification[i]?.value?.value);
                }
            }
        }
    }
}



// Variables for drag and drop functionality
let isDragging = false;
let startX;
let scrollLeft;

// Handle drag-to-scroll functionality
const sliders = document.querySelectorAll('.tableinnercols');
sliders.forEach(slider => {
    const startDrag = (e) => {
        isDragging = true;
        slider.classList.add('active');
        startX = e.pageX || e.touches[0].pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    };

    const stopDrag = () => {
        isDragging = false;
        slider.classList.remove('active');
    };

    const dragMove = (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX || e.touches[0].pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; // Scroll-fast
        slider.scrollLeft = scrollLeft - walk;
    };

    slider.addEventListener('mousedown', startDrag);
    slider.addEventListener('mouseleave', stopDrag);
    slider.addEventListener('mouseup', stopDrag);
    slider.addEventListener('mousemove', dragMove);

    slider.addEventListener('touchstart', startDrag);
    slider.addEventListener('touchend', stopDrag);
    slider.addEventListener('touchmove', dragMove);
});

// Synchronize scroll between elements
let isSyncingScroll = false;
const syncScrollElements = document.querySelectorAll('.tableinnercols');
syncScrollElements.forEach(el => {
    el.addEventListener('scroll', function () {
        if (isSyncingScroll) return;
        isSyncingScroll = true;
        const scrollLeft = el.scrollLeft;
        syncScrollElements.forEach(element => {
            if (element !== el) {
                element.scrollLeft = scrollLeft;
            }
        });
        isSyncingScroll = false;
    });
});

// Snap to column functionality
document.querySelectorAll('.tableinnercols').forEach(container => {
    let isScrolling;

    container.addEventListener('scroll', () => {
        clearTimeout(isScrolling);
        isScrolling = setTimeout(() => snapToCol(container), 100);
    });

    container.addEventListener('mousedown', () => {
        container.style.scrollSnapType = 'none';
    });

    container.addEventListener('mouseup', () => {
        container.style.scrollSnapType = 'x mandatory';
        snapToCol(container);
    });

    container.addEventListener('touchstart', () => {
        container.style.scrollSnapType = 'none';
    });

    container.addEventListener('touchend', () => {
        container.style.scrollSnapType = 'x mandatory';
        snapToCol(container);
    });
});

function snapToCol(container) {
    const colWidth = container.querySelector('.tablecol').offsetWidth;
    const scrollLeft = container.scrollLeft;
    const closestColIndex = Math.round(scrollLeft / colWidth);
    const newScrollLeft = closestColIndex * colWidth;
    container.scrollLeft = newScrollLeft;
}

// Adjust number of visible columns based on screen width
function adjustVisibleColumns() {
    const cols = document.querySelectorAll('.tablecol');
    const isMobile = window.innerWidth <= 768; // Adjust the breakpoint as needed
    if (isMobile) {
        // On mobile, show 2 columns
        cols.forEach(col => {
            col.style.width = 'calc(50vw - 10px)'; // Adjust for 2 columns with a bit of margin
        });
    } else {
        // On desktop, show 3 columns
        cols.forEach(col => {
            col.style.width = 'calc(33.33vw - 10px)'; // Adjust for 3 columns with a bit of margin
        });
    }
}

// Initial adjustment and on window resize
adjustVisibleColumns();
window.addEventListener('resize', adjustVisibleColumns);



$(document).ready(function () {
    $('.filtersidebar .filteroption .title').on('click', function () {
        var mainthis = $(this);
        mainthis.parent().toggleClass('active');
        mainthis.parent().find('.filtercontent').slideToggle();
    })
});

// $(document).ready(function() {
//     $('.carselectoroption').select2();
// });
