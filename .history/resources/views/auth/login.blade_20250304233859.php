
<!DOCTYPE html>
<html lang="en-US" class="hide-scroll">
<head> 
    <title>JVD Travel Management</title>
    <meta name="Keywords">
    <meta name="Description">
    

    <link rel="shortcut icon" href="https://csite.nicepage.com/favicon.ico" type="image/x-icon">

    
    


    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no,width=device-width">


<script src="//capp.nicepage.com/f5b278ee11255f67e69c029939c1178125d19d6d/main-libs.js" ></script>
<link href="//capp.nicepage.com/f5b278ee11255f67e69c029939c1178125d19d6d/main-libs.css" rel="stylesheet" />


    <link href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans:200,300,400,700,800,900&amp;subset=latin" rel="preload" as="font" />





<script>
    window.isAuthenticated = 0;
    window.useExternalGtmCode = 0;
    window.clientUserId = 0;
    window.clientUserName = '';
    window.userCountryCode = '';
    window.logPageEvent = 1;
    window.userHasAdsParams = 1;
    window.utmSourceFromReferrer = 0;
    window.currentLang = '';
    window.baseUrl = 'html-templates';
    window.currentUrl = 'html-templates';
    window.np_userId = '';
    window.isAmplitudeInitialized = false;
    window.sha256Email = '';

    function getCookieOrLocalStorage(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }
        var lsValue = localStorage.getItem(name);
        return !!lsValue;
    }

    function sendAnalyticsData(eventType, props, cb) {
        var json = { data: {} };
        json.userToken = np_userId;
        json.data.adsParams = $.cookie('AdsParameters');
        json.data.ga = $.cookie('_ga');
        json.data.gac = $.cookie('_gac_UA-88868916-2');
        json.data.userAgent = navigator.userAgent;
        json.data.eventType = eventType;
        json.data.props = props;
        $.ajax({
            'type': 'POST',
            'url': '/Feedback/SendAdsLog',
            'contentType': 'application/json; charset=utf-8',
            'data': JSON.stringify(json),
            'dataType': 'json',
            'complete': cb || function() {}
        });
    }

    function initializeAmplitudeUser() {
        if (isAmplitudeInitialized) {
            return;
        }
        isAmplitudeInitialized = true;

        if (clientUserId > 0)
        {
            identifyAmplitudeUser(clientUserId, clientUserName);
        }
        else
        {
            identifyAmplitudeUser(null);
        }
    }

    function sendAmplitudeAnalyticsData(eventName, eventProperties, userProperties, callback_function) {
        initializeAmplitudeUser();

        if (userProperties) {
            if(userProperties.utm_source || userProperties.utm_campaign) {
                var identify = new amplitude.Identify();
                identify.setOnce("utm_campaign", userProperties.utm_campaign);
                identify.setOnce("utm_source", userProperties.utm_source);
                identify.setOnce("utm_content", userProperties.utm_content);
                identify.setOnce("utm_group", userProperties.utm_group);
                identify.setOnce("utm_term", userProperties.utm_term);
                identify.setOnce("utm_page", userProperties.utm_page);
                identify.setOnce("utm_page2", userProperties.utm_page);
                identify.setOnce("referrer", userProperties.referrer);

                amplitude.getInstance().identify(identify);

                userProperties.utm_source_last = userProperties.utm_source;
                userProperties.utm_campaign_last = userProperties.utm_campaign;
                userProperties.utm_content_last = userProperties.utm_content;
                userProperties.utm_group_last = userProperties.utm_group;
                userProperties.utm_term_last = userProperties.utm_term;
                userProperties.utm_page_last = userProperties.utm_page;
            }

            var userProps = objectWithoutProperties(userProperties, ["utm_campaign", "utm_source","utm_content", "utm_term", "utm_page", "utm_group", "referrer"]);
            amplitude.getInstance().setUserProperties(userProps);
        }

        if (!eventProperties) {
            eventProperties = {};
        }

        eventProperties.WebSite = 'true';
        eventProperties.IsAuthenticated = window.isAuthenticated;
        eventProperties.country_code = getCountryCode();
        eventProperties.lang = window.currentLang || '';

        var fullPageUrl = window.location.pathname.split('?')[0];
        eventProperties.full_page_url = fullPageUrl;
        eventProperties.page_url = clearPageUrl(fullPageUrl);

        if (typeof callback_function === 'function') {
            amplitude.getInstance().logEvent(eventName, eventProperties, callback_function);
        } else {
            amplitude.getInstance().logEvent(eventName, eventProperties);
        }
    }

    function identifyAmplitudeUser(userId, token) {
        if (userId) {
            amplitude.getInstance().setUserProperties({
                "Token": token,
                "UserId": userId
            });
        }

        var identify = new amplitude.Identify();
        amplitude.getInstance().identify(identify);
        if (userId) {
            amplitude.getInstance().setUserId(userId);
        }
    }

    function getUtmParamsFromUrl() {
        var hash = window.location.hash;
        var url = new URL(window.location.href);
        if (hash && hash.indexOf('utm_') >= 0) {
            url = new URL(window.location.origin + window.location.pathname + hash.replace('#', '?'));
        }

        if (!url.searchParams) {
            return '';
        }
        return getUtmParams(url);
    }

    function hasGoogleIdFromUrl() {
        var url = new URL(window.location.href);
        if (!url.searchParams) {
            return false;
        }
        return !!url.searchParams.get('gclid');
    }

    function sendAnalyticsFromUrl(referrer, pageType) {
        var urlIsAvailable = typeof URL === "function" || (navigator.userAgent.indexOf('MSIE') !== -1 && typeof URL === 'object');
        if (!urlIsAvailable) {
            return;
        }

        var utmParams = getUtmParamsFromUrl();
        if (!utmParams) {
            return;
        }

        var gclidFromUrl = utmParams.gclid;
        var utmParamsFromUrl = !!utmParams.utmSource || !!utmParams.utmCampaign || !!utmParams.gclid;
        if (!utmParamsFromUrl && userHasAdsParams)
        {
            utmParams = getUtmParamsFromCookie();
        }

        var canLog = canLogToAmplitude(pageType);
        if (utmParamsFromUrl || utmSourceFromReferrer) {
            var fullPageUrl = window.location.pathname.split('?')[0];
            var pageUrl = clearPageUrl(fullPageUrl);
            var userProps = {
                "utm_source": utmParams.utmSource,
                "utm_campaign": utmParams.utmCampaign,
                "utm_content": utmParams.utmContent,
                "utm_group": utmParams.utmGroup,
                "utm_term": utmParams.utmTerm,
                "utm_page": getUtmPageValue(pageUrl),
                "utm_lang": window.currentLang || '',
                "referrer": referrer
            };

            if (gclidFromUrl) {
                var landingUrl = pageUrl.startsWith('/') && pageUrl !== '/' ? pageUrl.substr(1) : pageUrl;
                userProps.landing_page = landingUrl;

                var event = {
                    'Page': landingUrl,
                    'Url': window.location.href,
                    'utm_campaign_event': utmParams.utmCampaign,
                    'utm_group_event': utmParams.utmGroup

                }
                sendAmplitudeAnalyticsData('Landing Page', event, userProps);
            } else {
                var eventProps = {
                    "utm_source": utmParams.utmSource,
                    "utm_campaign": utmParams.utmCampaign,
                    "utm_content": utmParams.utmContent,
                    "utm_group": utmParams.utmGroup,
                    "utm_term": utmParams.utmTerm
                };

                if (utmParams.utmSource === "elastic") {
                    sendAmplitudeAnalyticsData('Email Click', eventProps);
                }

                if (canLog) {
                    sendAmplitudeAnalyticsData('Campaign', eventProps, userProps);
                }
            }
        }

        if (logPageEvent && canLog || (pageType === 'Pricing Page' && window.isValidCountry(true))) {
            var pageEventProps = {
                'type': pageType,
                'accepted_country': isValidCountry(),
                'force_log': !canLog
            };

            if (utmParams.gclid) {
                pageEventProps.googleClickId = utmParams.gclid;
            }

            sendAmplitudeAnalyticsData('Page View', pageEventProps);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (location.href.indexOf('/frame/') === -1 && window.location.href.indexOf('skipCookie') === -1) {
            PureCookie.initCookieConsent();
        }
        setCountryCode('https://location.nicepagesrv.com/country');
        setUserIdCookie();

        var referrer = '';
        var pageType = 'Template Page Preview';
        sendAnalyticsFromUrl(referrer, pageType);
    });
</script>

    <script>
        // Define dataLayer and the gtag function.
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }

        var consentDefaultValue = 'granted';
        gtag('consent', 'default', {
            'ad_storage': consentDefaultValue,
            'ad_user_data': consentDefaultValue,
            'ad_personalization': consentDefaultValue,
            'analytics_storage': consentDefaultValue
        });
        
        if (hasGoogleIdFromUrl()) {
            useExternalGtmCode = 1;
        }
    </script>
    <!-- Google Tag Manager -->
    <script>
        if (useExternalGtmCode) {
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://load.api9.nicepage.com/nldlswob.js?st='+i+dl+'';f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','W76XGFR');
        } else {
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-W76XGFR');
        }
    </script>
    <!-- End Google Tag Manager -->
    <!-- Facebook Pixel Code -->
        <script>
            if(window.hideFacebookPixelCode !== true) {
                !function (f, b, e, v, n, t, s) {
                    if (f.fbq) return; n = f.fbq = function () {
                        n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                    };
                    if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
                    n.queue = []; t = b.createElement(e); t.async = !0;
                    t.src = v; s = b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t, s)
                }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');

                var fbInitOptions = { em: '' };
                if (clientUserId > 0) {
                    fbInitOptions.external_id = clientUserId;
                }

                fbq('init', '251025992170426', fbInitOptions);
                fbq('track', 'PageView');
            }
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=251025992170426&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

<!-- Amplitude Code -->
<script type="text/javascript">
    (function(e,t){var n=e.amplitude||{_q:[],_iq:{}};var r=t.createElement("script")
            ;r.type="text/javascript"
            ;r.integrity="sha384-d/yhnowERvm+7eCU79T/bYjOiMmq4F11ElWYLmt0ktvYEVgqLDazh4+gW9CKMpYW"
            ;r.crossOrigin="anonymous";r.async=true
            ;r.src="https://cdn.amplitude.com/libs/amplitude-5.2.2-min.gz.js"
            ;r.onload=function(){if(!e.amplitude.runQueuedFunctions){
                console.log("[Amplitude] Error: could not load SDK")}}
            ;var i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)
            ;function s(e,t){e.prototype[t]=function(){
            this._q.push([t].concat(Array.prototype.slice.call(arguments,0)));return this}}
        var o=function(){this._q=[];return this}
            ;var a=["add","append","clearAll","prepend","set","setOnce","unset"]
            ;for(var u=0;u<a.length;u++){s(o,a[u])}n.Identify=o;var c=function(){this._q=[]
                ;return this}
            ;var l=["setProductId","setQuantity","setPrice","setRevenueType","setEventProperties"]
            ;for(var p=0;p<l.length;p++){s(c,l[p])}n.Revenue=c
            ;var d=["init","logEvent","logRevenue","setUserId","setUserProperties","setOptOut","setVersionName","setDomain","setDeviceId","setGlobalUserProperties","identify","clearUserProperties","setGroup","logRevenueV2","regenerateDeviceId","groupIdentify","onInit","logEventWithTimestamp","logEventWithGroups","setSessionId","resetSessionId"]
            ;function v(e){function t(t){e[t]=function(){
                e._q.push([t].concat(Array.prototype.slice.call(arguments,0)))}}
            for(var n=0;n<d.length;n++){t(d[n])}}v(n);n.getInstance=function(e){
                e=(!e||e.length===0?"$default_instance":e).toLowerCase()
                    ;if(!n._iq.hasOwnProperty(e)){n._iq[e]={_q:[]};v(n._iq[e])}return n._iq[e]}
            ;e.amplitude=n})(window,document);
    amplitude.getInstance().init("878f4709123a5451aff838c1f870b849");
</script>

<script>
var shareasaleSSCID=shareasaleGetParameterByName("sscid");function shareasaleSetCookie(e,a,r,s,t){if(e&&a){var o,n=s?"; path="+s:"",i=t?"; domain="+t:"",S="";r&&((o=new Date).setTime(o.getTime()+r),S="; expires="+o.toUTCString()),document.cookie=e+"="+a+S+n+i+"; SameSite=None;Secure"}}function shareasaleGetParameterByName(e,a){a||(a=window.location.href),e=e.replace(/[\[\]]/g,"\\$&");var r=new RegExp("[?&]"+e+"(=([^&#]*)|&|#|$)").exec(a);return r?r[2]?decodeURIComponent(r[2].replace(/\+/g," ")):"":null}shareasaleSSCID&&shareasaleSetCookie("shareasaleSSCID",shareasaleSSCID,94670778e4,"/");
</script>





<link rel="preconnect" href="https://images01.nicepagecdn.com" />
<link rel="preconnect" href="https://csite.nicepage.com" />

<!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->







    <script>
        window.serverSettings = {
            fbAppId: '290410448063109',
            googleAppId: '13150095650-mo8psu2colep6uv90a2mu6r87u87s35a.apps.googleusercontent.com'
        };
    </script>
    <script src="https://accounts.google.com/gsi/client?hl=en" async></script>
    <script src="//csite.nicepage.com/Scripts/Site/auth-common.js?version=f5b278ee11255f67e69c029939c1178125d19d6d" defer></script>


    
    <meta name="robots" content="noindex, nofollow">
    <script type="text/javascript">
        var device = 'desktop';
        function init($) {
            $('#previewDesktopBtn').click(function (e) {
                setLivePreviewFrameSize($(this));
                setActiveResponsiveButton(this);
                e.preventDefault();
            });

            $('#previewLaptopBtn').click(function (e) {
                setLivePreviewFrameSize($(this));
                setActiveResponsiveButton(this);
                e.preventDefault();
            });
            $('#previewTabletBtn').click(function (e) {
                setLivePreviewFrameSize($(this));
                setActiveResponsiveButton(this);
                e.preventDefault();
            });
            $('#previewPhoneHorizontalBtn').click(function (e) {
                setLivePreviewFrameSize($(this));
                setActiveResponsiveButton(this);
                e.preventDefault();
            });
            $('#previewPhoneBtn').click(function (e) {
                setLivePreviewFrameSize($(this));
                setActiveResponsiveButton(this);
                e.preventDefault();
            });

            detectActiveResponsiveButton();
        }

        if (jQuery.isReady) {
            init(jQuery);
        } else {
            jQuery(function ($) {
                init($);
            });
        }

        function setActiveResponsiveButton(btn) {
            $(".page-preview-header > a").removeClass("active");
            $(btn).addClass("active");
        }

        function detectActiveResponsiveButton() {
            var d = device;
            if (!d) {
                d = 'desktop';
            }
            $("#preview" + d.charAt(0).toUpperCase() + d.substr(1) + "Btn").click();
        }

        function getDataPreviewSizeAttr(el) {
            return el.closest("[data-preview-size]").attr("data-preview-size");
        }

        function setLivePreviewFrameSize(srcEl) {
            var getScrollbarWidth = function () {
                var s = $('<div style="width:100px;height:100px;overflow:scroll;visibility:hidden;position:absolute;top:-99999px"><div style="height:200px;"></div></div>')
                    .appendTo("body");
                var res = s.width() - s.find("div").last().width();
                s.remove();
                return res;
            };
            var attr = getDataPreviewSizeAttr(srcEl);
            $('#livePreviewFrame').width(attr.indexOf("%") !== -1 ? attr : parseInt(attr, 10) + getScrollbarWidth());
        }

    </script>
    <style>
        .dialog-wrapper {
            display: none !important;
        }

        .wrap,
        #main {
            height: 100vh;
            margin: 0 !important;
        }

        iframe {
            display: none;
        }


        html,
        body {
            height: 100%;
        }

        .page-preview {
            border-radius: 0;
            height: 100%;
        }

        .page-preview-header {
            background: #f2f2f2;
            border: none;
            height: 70px;
            position: relative;
            text-align: center;
        }

        .page-preview-header > a {
            display: inline-block;
            margin-top: 15px;
            padding: 4px;
        }

        .page-preview-header > a:hover {
            background: #e2f0fc;
            text-decoration: none;
        }

        .page-preview-header > a.active {
            background: #c9e4f9;
        }

        .page-preview-header > .close {
            float: right;
            margin-right: 10px;
        }

        .page-preview-body {
            height: calc(100% - 70px);
            overflow: hidden;
            text-align: center;
        }

        .page-preview-body iframe {
            border: none;
            display: inline-block;
            height: 100%;
        }
    </style>

</head>
    <body>
        


<div class="page-preview">
    <div class="page-preview-header">
        <a class="hidden-sm hidden-xs" href="#" id="previewDesktopBtn" data-preview-size="100%"><img alt="Responsive Desktop Mode" src="//csite.nicepage.com/Images/Site/responsive-desktop.png"></a>
        <a class="hidden-sm hidden-xs" href="#" id="previewLaptopBtn" data-preview-size="1040px"><img alt="Responsive Laptop Mode" src="//csite.nicepage.com/Images/Site/responsive-laptop.png"></a>
        <a class="hidden-xs" href="#" id="previewTabletBtn" data-preview-size="820px"><img alt="Responsive Tablet Mode" src="//csite.nicepage.com/Images/Site/responsive-tablet.png"></a>
        <a class="hidden-xs" href="#" id="previewPhoneHorizontalBtn" data-preview-size="640px"><img alt="Responsive Phone Horizontal Mode" src="//csite.nicepage.com/Images/Site/responsive-phone-horizontal.png"></a>
        <a class="hidden-xs" href="#" id="previewPhoneBtn" data-preview-size="440px"><img alt="Responsive Phone Mode" src="//csite.nicepage.com/Images/Site/responsive-phone.png"></a>
        <a class="close" href="/ht/6282702/meet-interior-studio-team-html-template"><img alt="Close" src="//csite.nicepage.com/Images/Site/icon-close.png"></a>
    </div>
    <div class="page-preview-body">
        <iframe id="livePreviewFrame" src="https://website6249008.nicepage.io/Our-Team.html?version=d286f111-7ed7-46f4-913a-dfb47cfe06d8" width="1057" height="640" style="width:100%;"></iframe>
    </div>
</div>
<a style="position:absolute;top:17px;left:10px;" href="/"><img alt="NicePage.com" src="//csite.nicepage.com/Images/logo-w.png"></a>

        <script>
            if (window.parent) {
                var _w = 0, _h = 0;
                var updateFormSize = function () {
                    var form = $('form.shaped-form-extended,form.shaped-form');
                    var w = form.outerWidth(true);
                    var h = form.outerHeight(true);
                    if (Math.abs(_w - w) > 5 || Math.abs(_h - h) > 5) {
                        _w = w;
                        _h = h;
                        var msg = { key: 'login-frame-size', width: w, height: h };
                        window.parent.postMessage(msg, "*");
                    }
                    setTimeout(updateFormSize, 300);
                }
                updateFormSize();
            }
        </script>
    </body>
</html>