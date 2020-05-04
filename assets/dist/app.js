/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/app.js":
/*!********************!*\
  !*** ./src/app.js ***!
  \********************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var packageName = __webpack_require__(/*! ./awselect/awselect.min */ "./src/awselect/awselect.min.js");

$(document).ready(function () {
  $('select').awselect();
});

/***/ }),

/***/ "./src/app.scss":
/*!**********************!*\
  !*** ./src/app.scss ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./src/awselect/awselect.min.js":
/*!**************************************!*\
  !*** ./src/awselect/awselect.min.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var awselect_count = 0,
    mobile_width = 800;
!function (t) {
  function e(e) {
    return t('.awselect[data-select="' + e.attr("id") + '"]');
  }

  function a(e, a) {
    var i = e.attr("data-placeholder"),
        n = e.attr("id"),
        s = e.children("option"),
        o = !1,
        l = "awselect",
        c = "",
        d = a.background,
        f = a.active_background,
        u = a.placeholder_color,
        h = a.placeholder_active_color,
        v = a.option_color,
        m = a.vertical_padding,
        w = a.horizontal_padding,
        p = a.immersive;
    if (p !== !0) var p = !1;
    s.each(function () {
      "undefined" != typeof t(this).attr("selected") && t(this).attr("selected") !== !1 && (o = t(this).text()), c += '<li><a style="padding: 2px ' + w + '">' + t(this).text() + "</a></li>";
    }), o !== !1 && (l += " hasValue"), "undefined" != typeof n && n !== !1 ? id_html = n : (id_html = "awselect_" + awselect_count, t(e).attr("id", id_html));

    var _ = '<div data-immersive="' + p + '" id="awselect_' + id_html + '" data-select="' + id_html + '" class = "' + l + '"><div style="background:' + f + '" class = "bg"></div>';

    _ += '<div style="padding:' + m + " " + w + '" class = "front_face">', _ += '<div style="background:' + d + '" class = "bg"></div>', _ += '<div data-inactive-color="' + h + '" style="color:' + u + '" class = "content">', o !== !1 && (_ += '<span class="current_value">' + o + "</span>"), _ += '<span class = "placeholder">' + i + "</span>", _ += '<i class = "icon">' + r(u) + "</i>", _ += "</div>", _ += "</div>", _ += '<div style="padding:' + m + ' 0;" class = "back_face"><ul style="color:' + v + '">', _ += c, _ += "</ul></div>", _ += "</div>", t(_).insertAfter(e), e.hide();
  }

  function i(e) {
    if (0 == e.hasClass("animating")) {
      if (e.addClass("animating"), t(".awselect.animate").length > 0) {
        s(t(".awselect").not(e));
        var a = 600;
      } else var a = 100;

      var i = e.attr("data-immersive");
      (t(window).width() < mobile_width || "true" == i) && (n(e), a += 200), setTimeout(function () {
        var a = e.find(".back_face");
        a.show();
        var n = e.find("> .bg");
        n.css({
          height: e.outerHeight() + a.outerHeight()
        }), a.css({
          "margin-top": t(e).outerHeight()
        }), (t(window).width() < mobile_width || "true" === i) && e.css({
          top: parseInt(e.css("top")) - a.height()
        }), e.addClass("placeholder_animate"), setTimeout(function () {
          l(e), setTimeout(function () {
            200 == a.outerHeight() && a.addClass("overflow");
          }, 200), e.addClass("placeholder_animate2"), e.addClass("animate"), e.addClass("animate2"), e.removeClass("animating");
        }, 100);
      }, a);
    }
  }

  function n(e) {
    t(".awselect_bg").remove(), t("body, html").addClass("immersive_awselect"), t("body").prepend('<div class = "awselect_bg"></div>'), setTimeout(function () {
      t(".awselect_bg").addClass("animate");
    }, 100);
    var a = e.outerWidth(),
        n = e.outerHeight(),
        s = e.offset().left,
        o = e.offset().top - t(window).scrollTop();
    e.attr("data-o-width", a), e.attr("data-o-left", s), e.attr("data-o-top", o), e.addClass("transition_paused").css({
      width: a,
      "z-index": "9999"
    }), setTimeout(function () {
      t('<div class = "awselect_placebo" style="position:relative; width:' + a + "px; height:" + n + 'px; float:left;ß"></div>').insertAfter(e), e.css({
        position: "fixed",
        top: o,
        left: s
      }), e.removeClass("transition_paused"), setTimeout(function () {
        t(window).width() < mobile_width ? e.css("width", t(window).outerWidth() - 40) : e.css("width", t(window).outerWidth() / 2), e.css({
          top: t(window).outerHeight() / 2 + e.outerHeight() / 2,
          left: "50%",
          transform: "translateX(-50%) translateY(-50%)"
        }), setTimeout(function () {
          i(e);
        }, 100);
      }, 100);
    }, 50);
  }

  function s(e) {
    if (null == e) var a = t(".awselect");else var a = e;
    t(a).each(function () {
      var e = t(this);
      e.hasClass("animate") && (setTimeout(function () {}, 300), e.removeClass("animate2"), e.find(".back_face").hide(), e.find(".back_face").removeClass("overflow"), e.removeClass("animate"), l(e), e.children(".bg").css({
        height: 0
      }), e.removeClass("placeholder_animate2"), setTimeout(function () {
        o(e), e.removeClass("placeholder_animate");
      }, 100));
    });
  }

  function o(e) {
    e.siblings(".awselect_placebo").length > 0 && setTimeout(function () {
      var a = e.attr("data-o-width"),
          i = e.attr("data-o-left"),
          n = e.attr("data-o-top");
      e.css({
        width: a,
        left: i + "px",
        transform: "translateX(0) translateY(0)",
        top: n + "px"
      }), t(".awselect_bg").removeClass("animate"), setTimeout(function () {
        t(".awselect_placebo").remove(), t("body, html").removeClass("immersive_awselect"), setTimeout(function () {
          t(".awselect_bg").removeClass("animate").remove();
        }, 200), e.attr("style", "");
      }, 300);
    }, 100);
  }

  function l(t) {
    var e = t.find(".front_face .content").attr("data-inactive-color"),
        a = t.find(".front_face .content").css("color");
    t.find(".front_face .content").attr("data-inactive-color", a), t.find(".front_face .content").css("color", e), t.find(".front_face .icon svg").css("fill", e);
  }

  function c(a) {
    var i = t(a).val(),
        n = e(t(a)),
        o = t(a).children('option[value="' + i + '"]').eq(0),
        l = t(a).attr("data-callback");
    t(n).find(".current_value").remove(), t(n).find(".front_face .content").prepend('<span class = "current_value">' + o.text() + "</span>"), t(n).addClass("hasValue"), "undefined" != typeof l && l !== !1 && window[l](o.val()), setTimeout(function () {
      s();
    }, 100);
  }

  function r(t) {
    return '<svg style="fill:' + t + '" version="1.1" id="Chevron_thin_down" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve"><path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0c0.27,0.268,0.271,0.701,0,0.969l-7.908,7.83c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25L17.418,6.109z"/></svg>';
  }

  t(document).mouseup(function (e) {
    var a = t(".awselect");
    a.is(e.target) || 0 !== a.has(e.target).length || s();
  }), t.fn.awselect = function (n) {
    var o = t(this),
        l = t.extend({}, t.fn.awselect.defaults, n);
    return o.each(function () {
      awselect_count += 1, a(t(this), l);
    }), this.on("aw:animate", function () {
      i(e(t(this)));
    }), this.on("change", function () {
      c(this);
    }), this.on("aw:deanimate", function () {
      s(e(t(this)));
    }), console.log(o.attr("id")), {
      blue: function blue() {
        o.css("color", "blue");
      }
    };
  }, t.fn.awselect.defaults = {
    background: "#e5e5e5",
    active_background: "#fff",
    placeholder_color: "#000",
    placeholder_active_color: "#000",
    option_color: "#000",
    vertical_padding: "15px",
    horizontal_padding: "40px",
    immersive: !1
  };
}(jQuery), $(document).ready(function () {
  $("body").on("click", ".awselect .front_face", function () {
    var t = $(this).parent(".awselect");
    0 == t.hasClass("animate") ? $("select#" + t.attr("id").replace("awselect_", "")).trigger("aw:animate") : $("select#" + t.attr("id").replace("awselect_", "")).trigger("aw:deanimate");
  }), $("body").on("click", ".awselect ul li a", function () {
    var t = $(this).parents(".awselect"),
        e = $(this).parent("li").index(),
        a = t.attr("data-select"),
        i = $("select#" + a),
        n = $(i).children("option").eq(e);
    $(i).attr("data-callback");
    $(i).val(n.val()), $(i).trigger("change");
  });
});

/***/ }),

/***/ 0:
/*!*****************************************!*\
  !*** multi ./src/app.js ./src/app.scss ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\ciblog\assets\src\app.js */"./src/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\ciblog\assets\src\app.scss */"./src/app.scss");


/***/ })

/******/ });