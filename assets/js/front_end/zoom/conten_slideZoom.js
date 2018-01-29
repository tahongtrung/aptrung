

function checkGalleryZoom(n) {
    n.options.zoomEnabled = n.largeWidth < detailsVideoParams.width ? !1 : !0
}
/* set width zoom*/
function initProductDetailsGallery() {
    var t = $("#product_gallery .stage > img"), u = $(window).width(), i = 0, r = 0, n;
    u > 1270 ? (i = 390, r = 390) : (i = 300, r = 300);
    u < 992 ? (i = 310, r = 310) : (i = 300, r = 300);
    t.elevateZoom({borderSize: 1, borderColour: "#eee", zoomWindowPosition: 1, zoomWindowOffetx: 16, easing: !1, zoomWindowWidth: i, zoomWindowHeight: r, onImageSwap: function () {
        n.options.zoomEnabled = !1
    }});
    initProductDetailsGalleryNavigation();
    n = $("#product_gallery .stage > img").data("elevateZoom");
    n.options.onImageSwapComplete = n.options.onZoomedImageLoaded = function () {
        checkGalleryZoom(n)
    };
    $("#product_gallery > .thumbnails > .items").on("mouseover", "> .item", function () {
        var i = $(this), u, r;
        i.addClass("active").siblings(".active").removeClass("active");
        switch (i.data("type")) {
            case"image":
                $(t).hasClass("hide") && $(t).removeClass("hide");
                $(".zoomContainer").show();
                $("#video_player").hide();
                n.swaptheimage(i.data("image"), i.data("zoom-image"));
                break;
        }
    })
}
function addItemsToGallery(n, t) {
    for (var r = "", i = 0; i < n.length; i++)r += i == 0 ? '<div class="item active" data-type="image" data-image="' + n[i].ImageLarger + '" data-zoom-image="' + n[i].ImageReal + '"><img src="' + n[i].ImageSmall + '" /><\/div>' : '<div class="item" data-type="image" data-image="' + n[i].ImageLarger + '" data-zoom-image="' + n[i].ImageReal + '"><img src="' + n[i].ImageSmall + '" /><\/div>';
    t != "" && t !== undefined && t != null && (r += '<div class="item" data-type="video" data-youtube-id="' + t + '"><img src="https://img.youtube.com/vi/' + t + '/maxresdefault.jpg" /><\/div>');
    $("#product_gallery > .thumbnails > .items").append(r);
    $("#product_gallery > .thumbnails > .items >.item:first-child").trigger("mouseover")
}
function removeItemsFromGallery() {
    $("#product_gallery > .thumbnails > .items").empty();
    $("#product_gallery > .stage > img").src = "";
    "undefined" != typeof player && "undefined" != typeof player.destroy && null !== player.f && player.destroy()
}


/*mouse hover list casel*/
function initProductDetailsGalleryNavigation() {
    var t = $("#product_gallery > .thumbnails > .items"), i = $("#product_gallery"), r = 280, u, n;
    if ($(".thoi-trang").length > 0 && (r = 438), t.css("max-height", ""), u = t.height(), u > r) {
        t.css("max-height", r + "px");
        n = t.niceScroll({cursoropacitymax: 0});
        i.find(".prev").show().on("click", function () {
            n.doScrollTop(n.getScrollTop() - 96)
        });
        i.find(".next").show().on("click", function () {
            n.doScrollTop(n.getScrollTop() + 96)
        });
        i.find(".prev,.next").show();
        el = n.hide()
    } else i.find(".prev,.next").hide()
}


/* close zoomimage*/
zoomImage = function () {
    function u() {
        image.height > t && image.width > n && $("#sync1 .synced img").elevateZoom({borderSize: 1, borderColour: "#ccc", zoomWindowPosition: "zoom-container", easing: !1, zoomWindowWidth: n, zoomWindowHeight: t})
    }

    var f = $(window).width(), n = 0, t = 0, i, r;
    f > 1270 ? (n = 502, t = 502) : (n = 470, t = 470);
    i = $("#sync1 .synced img");
    r = $(i).data("zoom-image");
    image = new Image;
    image.src = r;
    image.complete ? u() : image.onload = u
};

detailsVideoParams = {width: 346, height: 500}, function (n) {
    typeof define == "function" && define.amd ? define(["jquery"], n) : n(jQuery)
}(function (n) {
    function r(t, i) {
        var r, f, e, o = t.nodeName.toLowerCase();
        return"area" === o ? (r = t.parentNode, f = r.name, !t.href || !f || r.nodeName.toLowerCase() !== "map") ? !1 : (e = n("img[usemap='#" + f + "']")[0], !!e && u(e)) : (/input|select|textarea|button|object/.test(o) ? !t.disabled : "a" === o ? t.href || i : i) && u(t)
    }

    function u(t) {
        return n.expr.filters.visible(t) && !n(t).parents().addBack().filter(function () {
            return n.css(this, "visibility") === "hidden"
        }).length
    }

    var f, i, e, t, o, s, h, c;
    n.ui = n.ui || {};
    n.extend(n.ui, {version: "1.11.2", keyCode: {BACKSPACE: 8, COMMA: 188, DELETE: 46, DOWN: 40, END: 35, ENTER: 13, ESCAPE: 27, HOME: 36, LEFT: 37, PAGE_DOWN: 34, PAGE_UP: 33, PERIOD: 190, RIGHT: 39, SPACE: 32, TAB: 9, UP: 38}});
    n.fn.extend({scrollParent: function (t) {
        var i = this.css("position"), u = i === "absolute", f = t ? /(auto|scroll|hidden)/ : /(auto|scroll)/, r = this.parents().filter(function () {
            var t = n(this);
            return u && t.css("position") === "static" ? !1 : f.test(t.css("overflow") + t.css("overflow-y") + t.css("overflow-x"))
        }).eq(0);
        return i === "fixed" || !r.length ? n(this[0].ownerDocument || document) : r
    }, uniqueId: function () {
        var n = 0;
        return function () {
            return this.each(function () {
                this.id || (this.id = "ui-id-" + ++n)
            })
        }
    }(), removeUniqueId: function () {
        return this.each(function () {
            /^ui-id-\d+$/.test(this.id) && n(this).removeAttr("id")
        })
    }});
    n.extend(n.expr[":"], {data: n.expr.createPseudo ? n.expr.createPseudo(function (t) {
        return function (i) {
            return!!n.data(i, t)
        }
    }) : function (t, i, r) {
        return!!n.data(t, r[3])
    }, focusable: function (t) {
        return r(t, !isNaN(n.attr(t, "tabindex")))
    }, tabbable: function (t) {
        var i = n.attr(t, "tabindex"), u = isNaN(i);
        return(u || i >= 0) && r(t, !u)
    }});
    n("<a>").outerWidth(1).jquery || n.each(["Width", "Height"], function (t, i) {
        function r(t, i, r, u) {
            return n.each(e, function () {
                i -= parseFloat(n.css(t, "padding" + this)) || 0;
                r && (i -= parseFloat(n.css(t, "border" + this + "Width")) || 0);
                u && (i -= parseFloat(n.css(t, "margin" + this)) || 0)
            }), i
        }

        var e = i === "Width" ? ["Left", "Right"] : ["Top", "Bottom"], u = i.toLowerCase(), f = {innerWidth: n.fn.innerWidth, innerHeight: n.fn.innerHeight, outerWidth: n.fn.outerWidth, outerHeight: n.fn.outerHeight};
        n.fn["inner" + i] = function (t) {
            return t === undefined ? f["inner" + i].call(this) : this.each(function () {
                n(this).css(u, r(this, t) + "px")
            })
        };
        n.fn["outer" + i] = function (t, e) {
            return typeof t != "number" ? f["outer" + i].call(this, t) : this.each(function () {
                n(this).css(u, r(this, t, !0, e) + "px")
            })
        }
    });
    n.fn.addBack || (n.fn.addBack = function (n) {
        return this.add(n == null ? this.prevObject : this.prevObject.filter(n))
    });
    n("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (n.fn.removeData = function (t) {
        return function (i) {
            return arguments.length ? t.call(this, n.camelCase(i)) : t.call(this)
        }
    }(n.fn.removeData));
    n.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());
    n.fn.extend({focus: function (t) {
        return function (i, r) {
            return typeof i == "number" ? this.each(function () {
                var t = this;
                setTimeout(function () {
                    n(t).focus();
                    r && r.call(t)
                }, i)
            }) : t.apply(this, arguments)
        }
    }(n.fn.focus), disableSelection: function () {
        var n = "onselectstart"in document.createElement("div") ? "selectstart" : "mousedown";
        return function () {
            return this.bind(n + ".ui-disableSelection", function (n) {
                n.preventDefault()
            })
        }
    }(), enableSelection: function () {
        return this.unbind(".ui-disableSelection")
    }, zIndex: function (t) {
        if (t !== undefined)return this.css("zIndex", t);
        if (this.length)for (var i = n(this[0]), r, u; i.length && i[0] !== document;) {
            if (r = i.css("position"), (r === "absolute" || r === "relative" || r === "fixed") && (u = parseInt(i.css("zIndex"), 10), !isNaN(u) && u !== 0))return u;
            i = i.parent()
        }
        return 0
    }});
    n.ui.plugin = {add: function (t, i, r) {
        var u, f = n.ui[t].prototype;
        for (u in r)f.plugins[u] = f.plugins[u] || [], f.plugins[u].push([i, r[u]])
    }, call: function (n, t, i, r) {
        var u, f = n.plugins[t];
        if (f && (r || n.element[0].parentNode && n.element[0].parentNode.nodeType !== 11))for (u = 0; u < f.length; u++)n.options[f[u][0]] && f[u][1].apply(n.element, i)
    }};
    f = 0;
    i = Array.prototype.slice;
    n.cleanData = function (t) {
        return function (i) {
            for (var r, u, f = 0; (u = i[f]) != null; f++)try {
                r = n._data(u, "events");
                r && r.remove && n(u).triggerHandler("remove")
            } catch (e) {
            }
            t(i)
        }
    }(n.cleanData);
    n.widget = function (t, i, r) {
        var s, f, u, o, h = {}, e = t.split(".")[0];
        return t = t.split(".")[1], s = e + "-" + t, r || (r = i, i = n.Widget), n.expr[":"][s.toLowerCase()] = function (t) {
            return!!n.data(t, s)
        }, n[e] = n[e] || {}, f = n[e][t], u = n[e][t] = function (n, t) {
            if (!this._createWidget)return new u(n, t);
            arguments.length && this._createWidget(n, t)
        }, n.extend(u, f, {version: r.version, _proto: n.extend({}, r), _childConstructors: []}), o = new i, o.options = n.widget.extend({}, o.options), n.each(r, function (t, r) {
            if (!n.isFunction(r)) {
                h[t] = r;
                return
            }
            h[t] = function () {
                var n = function () {
                    return i.prototype[t].apply(this, arguments)
                }, u = function (n) {
                    return i.prototype[t].apply(this, n)
                };
                return function () {
                    var i = this._super, f = this._superApply, t;
                    return this._super = n, this._superApply = u, t = r.apply(this, arguments), this._super = i, this._superApply = f, t
                }
            }()
        }), u.prototype = n.widget.extend(o, {widgetEventPrefix: f ? o.widgetEventPrefix || t : t}, h, {constructor: u, namespace: e, widgetName: t, widgetFullName: s}), f ? (n.each(f._childConstructors, function (t, i) {
            var r = i.prototype;
            n.widget(r.namespace + "." + r.widgetName, u, i._proto)
        }), delete f._childConstructors) : i._childConstructors.push(u), n.widget.bridge(t, u), u
    };
    n.widget.extend = function (t) {
        for (var e = i.call(arguments, 1), f = 0, o = e.length, r, u; f < o; f++)for (r in e[f])u = e[f][r], e[f].hasOwnProperty(r) && u !== undefined && (t[r] = n.isPlainObject(u) ? n.isPlainObject(t[r]) ? n.widget.extend({}, t[r], u) : n.widget.extend({}, u) : u);
        return t
    };
    n.widget.bridge = function (t, r) {
        var u = r.prototype.widgetFullName || t;
        n.fn[t] = function (f) {
            var s = typeof f == "string", o = i.call(arguments, 1), e = this;
            return f = !s && o.length ? n.widget.extend.apply(null, [f].concat(o)) : f, s ? this.each(function () {
                var i, r = n.data(this, u);
                return f === "instance" ? (e = r, !1) : r ? !n.isFunction(r[f]) || f.charAt(0) === "_" ? n.error("no such method '" + f + "' for " + t + " widget instance") : (i = r[f].apply(r, o), i !== r && i !== undefined ? (e = i && i.jquery ? e.pushStack(i.get()) : i, !1) : void 0) : n.error("cannot call methods on " + t + " prior to initialization; attempted to call method '" + f + "'")
            }) : this.each(function () {
                var t = n.data(this, u);
                t ? (t.option(f || {}), t._init && t._init()) : n.data(this, u, new r(f, this))
            }), e
        }
    };
    n.Widget = function () {
    };
    n.Widget._childConstructors = [];
    n.Widget.prototype = {widgetName: "widget", widgetEventPrefix: "", defaultElement: "<div>", options: {disabled: !1, create: null}, _createWidget: function (t, i) {
        i = n(i || this.defaultElement || this)[0];
        this.element = n(i);
        this.uuid = f++;
        this.eventNamespace = "." + this.widgetName + this.uuid;
        this.bindings = n();
        this.hoverable = n();
        this.focusable = n();
        i !== this && (n.data(i, this.widgetFullName, this), this._on(!0, this.element, {remove: function (n) {
            n.target === i && this.destroy()
        }}), this.document = n(i.style ? i.ownerDocument : i.document || i), this.window = n(this.document[0].defaultView || this.document[0].parentWindow));
        this.options = n.widget.extend({}, this.options, this._getCreateOptions(), t);
        this._create();
        this._trigger("create", null, this._getCreateEventData());
        this._init()
    }, _getCreateOptions: n.noop, _getCreateEventData: n.noop, _create: n.noop, _init: n.noop, destroy: function () {
        this._destroy();
        this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(n.camelCase(this.widgetFullName));
        this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled");
        this.bindings.unbind(this.eventNamespace);
        this.hoverable.removeClass("ui-state-hover");
        this.focusable.removeClass("ui-state-focus")
    }, _destroy: n.noop, widget: function () {
        return this.element
    }, option: function (t, i) {
        var e = t, r, u, f;
        if (arguments.length === 0)return n.widget.extend({}, this.options);
        if (typeof t == "string")if (e = {}, r = t.split("."), t = r.shift(), r.length) {
            for (u = e[t] = n.widget.extend({}, this.options[t]), f = 0; f < r.length - 1; f++)u[r[f]] = u[r[f]] || {}, u = u[r[f]];
            if (t = r.pop(), arguments.length === 1)return u[t] === undefined ? null : u[t];
            u[t] = i
        } else {
            if (arguments.length === 1)return this.options[t] === undefined ? null : this.options[t];
            e[t] = i
        }
        return this._setOptions(e), this
    }, _setOptions: function (n) {
        var t;
        for (t in n)this._setOption(t, n[t]);
        return this
    }, _setOption: function (n, t) {
        return this.options[n] = t, n === "disabled" && (this.widget().toggleClass(this.widgetFullName + "-disabled", !!t), t && (this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus"))), this
    }, enable: function () {
        return this._setOptions({disabled: !1})
    }, disable: function () {
        return this._setOptions({disabled: !0})
    }, _on: function (t, i, r) {
        var f, u = this;
        typeof t != "boolean" && (r = i, i = t, t = !1);
        r ? (i = f = n(i), this.bindings = this.bindings.add(i)) : (r = i, i = this.element, f = this.widget());
        n.each(r, function (r, e) {
            function o() {
                if (t || u.options.disabled !== !0 && !n(this).hasClass("ui-state-disabled"))return(typeof e == "string" ? u[e] : e).apply(u, arguments)
            }

            typeof e != "string" && (o.guid = e.guid = e.guid || o.guid || n.guid++);
            var s = r.match(/^([\w:-]*)\s*(.*)$/), h = s[1] + u.eventNamespace, c = s[2];
            c ? f.delegate(c, h, o) : i.bind(h, o)
        })
    }, _off: function (t, i) {
        i = (i || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace;
        t.unbind(i).undelegate(i);
        this.bindings = n(this.bindings.not(t).get());
        this.focusable = n(this.focusable.not(t).get());
        this.hoverable = n(this.hoverable.not(t).get())
    }, _delay: function (n, t) {
        function r() {
            return(typeof n == "string" ? i[n] : n).apply(i, arguments)
        }

        var i = this;
        return setTimeout(r, t || 0)
    }, _hoverable: function (t) {
        this.hoverable = this.hoverable.add(t);
        this._on(t, {mouseenter: function (t) {
            n(t.currentTarget).addClass("ui-state-hover")
        }, mouseleave: function (t) {
            n(t.currentTarget).removeClass("ui-state-hover")
        }})
    }, _focusable: function (t) {
        this.focusable = this.focusable.add(t);
        this._on(t, {focusin: function (t) {
            n(t.currentTarget).addClass("ui-state-focus")
        }, focusout: function (t) {
            n(t.currentTarget).removeClass("ui-state-focus")
        }})
    }, _trigger: function (t, i, r) {
        var u, f, e = this.options[t];
        if (r = r || {}, i = n.Event(i), i.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), i.target = this.element[0], f = i.originalEvent, f)for (u in f)u in i || (i[u] = f[u]);
        return this.element.trigger(i, r), !(n.isFunction(e) && e.apply(this.element[0], [i].concat(r)) === !1 || i.isDefaultPrevented())
    }};
    n.each({show: "fadeIn", hide: "fadeOut"}, function (t, i) {
        n.Widget.prototype["_" + t] = function (r, u, f) {
            typeof u == "string" && (u = {effect: u});
            var o, e = u ? u === !0 || typeof u == "number" ? i : u.effect || i : t;
            u = u || {};
            typeof u == "number" && (u = {duration: u});
            o = !n.isEmptyObject(u);
            u.complete = f;
            u.delay && r.delay(u.delay);
            o && n.effects && n.effects.effect[e] ? r[t](u) : e !== t && r[e] ? r[e](u.duration, u.easing, f) : r.queue(function (i) {
                n(this)[t]();
                f && f.call(r[0]);
                i()
            })
        }
    });
    e = n.widget;
    t = !1;
    n(document).mouseup(function () {
        t = !1
    });
    o = n.widget("ui.mouse", {version: "1.11.2", options: {cancel: "input,textarea,button,select,option", distance: 1, delay: 0}, _mouseInit: function () {
        var t = this;
        this.element.bind("mousedown." + this.widgetName,function (n) {
            return t._mouseDown(n)
        }).bind("click." + this.widgetName, function (i) {
                if (!0 === n.data(i.target, t.widgetName + ".preventClickEvent"))return n.removeData(i.target, t.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1
            });
        this.started = !1
    }, _mouseDestroy: function () {
        this.element.unbind("." + this.widgetName);
        this._mouseMoveDelegate && this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
    }, _mouseDown: function (i) {
        if (!t) {
            this._mouseMoved = !1;
            this._mouseStarted && this._mouseUp(i);
            this._mouseDownEvent = i;
            var r = this, u = i.which === 1, f = typeof this.options.cancel == "string" && i.target.nodeName ? n(i.target).closest(this.options.cancel).length : !1;
            return!u || f || !this._mouseCapture(i) ? !0 : (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function () {
                r.mouseDelayMet = !0
            }, this.options.delay)), this._mouseDistanceMet(i) && this._mouseDelayMet(i) && (this._mouseStarted = this._mouseStart(i) !== !1, !this._mouseStarted)) ? (i.preventDefault(), !0) : (!0 === n.data(i.target, this.widgetName + ".preventClickEvent") && n.removeData(i.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function (n) {
                return r._mouseMove(n)
            }, this._mouseUpDelegate = function (n) {
                return r._mouseUp(n)
            }, this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), i.preventDefault(), t = !0, !0)
        }
    }, _mouseMove: function (t) {
        return this._mouseMoved && (n.ui.ie && (!document.documentMode || document.documentMode < 9) && !t.button || !t.which) ? this._mouseUp(t) : ((t.which || t.button) && (this._mouseMoved = !0), this._mouseStarted) ? (this._mouseDrag(t), t.preventDefault()) : (this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, t) !== !1, this._mouseStarted ? this._mouseDrag(t) : this._mouseUp(t)), !this._mouseStarted)
    }, _mouseUp: function (i) {
        return this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, i.target === this._mouseDownEvent.target && n.data(i.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(i)), t = !1, !1
    }, _mouseDistanceMet: function (n) {
        return Math.max(Math.abs(this._mouseDownEvent.pageX - n.pageX), Math.abs(this._mouseDownEvent.pageY - n.pageY)) >= this.options.distance
    }, _mouseDelayMet: function () {
        return this.mouseDelayMet
    }, _mouseStart: function () {
    }, _mouseDrag: function () {
    }, _mouseStop: function () {
    }, _mouseCapture: function () {
        return!0
    }}), function () {
        function f(n, t, i) {
            return[parseFloat(n[0]) * (a.test(n[0]) ? t / 100 : 1), parseFloat(n[1]) * (a.test(n[1]) ? i / 100 : 1)]
        }

        function i(t, i) {
            return parseInt(n.css(t, i), 10) || 0
        }

        function v(t) {
            var i = t[0];
            return i.nodeType === 9 ? {width: t.width(), height: t.height(), offset: {top: 0, left: 0}} : n.isWindow(i) ? {width: t.width(), height: t.height(), offset: {top: t.scrollTop(), left: t.scrollLeft()}} : i.preventDefault ? {width: 0, height: 0, offset: {top: i.pageY, left: i.pageX}} : {width: t.outerWidth(), height: t.outerHeight(), offset: t.offset()}
        }

        n.ui = n.ui || {};
        var u, e, r = Math.max, t = Math.abs, o = Math.round, s = /left|center|right/, h = /top|center|bottom/, c = /[\+\-]\d+(\.[\d]+)?%?/, l = /^\w+/, a = /%$/, y = n.fn.position;
        n.position = {scrollbarWidth: function () {
            if (u !== undefined)return u;
            var r, i, t = n("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'><\/div><\/div>"), f = t.children()[0];
            return n("body").append(t), r = f.offsetWidth, t.css("overflow", "scroll"), i = f.offsetWidth, r === i && (i = t[0].clientWidth), t.remove(), u = r - i
        }, getScrollInfo: function (t) {
            var i = t.isWindow || t.isDocument ? "" : t.element.css("overflow-x"), r = t.isWindow || t.isDocument ? "" : t.element.css("overflow-y"), u = i === "scroll" || i === "auto" && t.width < t.element[0].scrollWidth, f = r === "scroll" || r === "auto" && t.height < t.element[0].scrollHeight;
            return{width: f ? n.position.scrollbarWidth() : 0, height: u ? n.position.scrollbarWidth() : 0}
        }, getWithinInfo: function (t) {
            var i = n(t || window), r = n.isWindow(i[0]), u = !!i[0] && i[0].nodeType === 9;
            return{element: i, isWindow: r, isDocument: u, offset: i.offset() || {left: 0, top: 0}, scrollLeft: i.scrollLeft(), scrollTop: i.scrollTop(), width: r || u ? i.width() : i.outerWidth(), height: r || u ? i.height() : i.outerHeight()}
        }};
        n.fn.position = function (u) {
            if (!u || !u.of)return y.apply(this, arguments);
            u = n.extend({}, u);
            var k, a, p, b, w, g, nt = n(u.of), it = n.position.getWithinInfo(u.within), rt = n.position.getScrollInfo(it), d = (u.collision || "flip").split(" "), tt = {};
            return g = v(nt), nt[0].preventDefault && (u.at = "left top"), a = g.width, p = g.height, b = g.offset, w = n.extend({}, b), n.each(["my", "at"], function () {
                var n = (u[this] || "").split(" "), t, i;
                n.length === 1 && (n = s.test(n[0]) ? n.concat(["center"]) : h.test(n[0]) ? ["center"].concat(n) : ["center", "center"]);
                n[0] = s.test(n[0]) ? n[0] : "center";
                n[1] = h.test(n[1]) ? n[1] : "center";
                t = c.exec(n[0]);
                i = c.exec(n[1]);
                tt[this] = [t ? t[0] : 0, i ? i[0] : 0];
                u[this] = [l.exec(n[0])[0], l.exec(n[1])[0]]
            }), d.length === 1 && (d[1] = d[0]), u.at[0] === "right" ? w.left += a : u.at[0] === "center" && (w.left += a / 2), u.at[1] === "bottom" ? w.top += p : u.at[1] === "center" && (w.top += p / 2), k = f(tt.at, a, p), w.left += k[0], w.top += k[1], this.each(function () {
                var y, g, h = n(this), c = h.outerWidth(), l = h.outerHeight(), ut = i(this, "marginLeft"), ft = i(this, "marginTop"), et = c + ut + i(this, "marginRight") + rt.width, ot = l + ft + i(this, "marginBottom") + rt.height, s = n.extend({}, w), v = f(tt.my, h.outerWidth(), h.outerHeight());
                u.my[0] === "right" ? s.left -= c : u.my[0] === "center" && (s.left -= c / 2);
                u.my[1] === "bottom" ? s.top -= l : u.my[1] === "center" && (s.top -= l / 2);
                s.left += v[0];
                s.top += v[1];
                e || (s.left = o(s.left), s.top = o(s.top));
                y = {marginLeft: ut, marginTop: ft};
                n.each(["left", "top"], function (t, i) {
                    n.ui.position[d[t]] && n.ui.position[d[t]][i](s, {targetWidth: a, targetHeight: p, elemWidth: c, elemHeight: l, collisionPosition: y, collisionWidth: et, collisionHeight: ot, offset: [k[0] + v[0], k[1] + v[1]], my: u.my, at: u.at, within: it, elem: h})
                });
                u.using && (g = function (n) {
                    var i = b.left - s.left, o = i + a - c, f = b.top - s.top, v = f + p - l, e = {target: {element: nt, left: b.left, top: b.top, width: a, height: p}, element: {element: h, left: s.left, top: s.top, width: c, height: l}, horizontal: o < 0 ? "left" : i > 0 ? "right" : "center", vertical: v < 0 ? "top" : f > 0 ? "bottom" : "middle"};
                    a < c && t(i + o) < a && (e.horizontal = "center");
                    p < l && t(f + v) < p && (e.vertical = "middle");
                    e.important = r(t(i), t(o)) > r(t(f), t(v)) ? "horizontal" : "vertical";
                    u.using.call(this, n, e)
                });
                h.offset(n.extend(s, {using: g}))
            })
        };
        n.ui.position = {fit: {left: function (n, t) {
            var e = t.within, u = e.isWindow ? e.scrollLeft : e.offset.left, o = e.width, s = n.left - t.collisionPosition.marginLeft, i = u - s, f = s + t.collisionWidth - o - u, h;
            t.collisionWidth > o ? i > 0 && f <= 0 ? (h = n.left + i + t.collisionWidth - o - u, n.left += i - h) : n.left = f > 0 && i <= 0 ? u : i > f ? u + o - t.collisionWidth : u : i > 0 ? n.left += i : f > 0 ? n.left -= f : n.left = r(n.left - s, n.left)
        }, top: function (n, t) {
            var o = t.within, u = o.isWindow ? o.scrollTop : o.offset.top, e = t.within.height, s = n.top - t.collisionPosition.marginTop, i = u - s, f = s + t.collisionHeight - e - u, h;
            t.collisionHeight > e ? i > 0 && f <= 0 ? (h = n.top + i + t.collisionHeight - e - u, n.top += i - h) : n.top = f > 0 && i <= 0 ? u : i > f ? u + e - t.collisionHeight : u : i > 0 ? n.top += i : f > 0 ? n.top -= f : n.top = r(n.top - s, n.top)
        }}, flip: {left: function (n, i) {
            var r = i.within, y = r.offset.left + r.scrollLeft, c = r.width, o = r.isWindow ? r.scrollLeft : r.offset.left, l = n.left - i.collisionPosition.marginLeft, a = l - o, v = l + i.collisionWidth - c - o, u = i.my[0] === "left" ? -i.elemWidth : i.my[0] === "right" ? i.elemWidth : 0, f = i.at[0] === "left" ? i.targetWidth : i.at[0] === "right" ? -i.targetWidth : 0, e = -2 * i.offset[0], s, h;
            a < 0 ? (s = n.left + u + f + e + i.collisionWidth - c - y, (s < 0 || s < t(a)) && (n.left += u + f + e)) : v > 0 && (h = n.left - i.collisionPosition.marginLeft + u + f + e - o, (h > 0 || t(h) < v) && (n.left += u + f + e))
        }, top: function (n, i) {
            var r = i.within, y = r.offset.top + r.scrollTop, a = r.height, o = r.isWindow ? r.scrollTop : r.offset.top, v = n.top - i.collisionPosition.marginTop, s = v - o, h = v + i.collisionHeight - a - o, p = i.my[1] === "top", u = p ? -i.elemHeight : i.my[1] === "bottom" ? i.elemHeight : 0, f = i.at[1] === "top" ? i.targetHeight : i.at[1] === "bottom" ? -i.targetHeight : 0, e = -2 * i.offset[1], c, l;
            s < 0 ? (l = n.top + u + f + e + i.collisionHeight - a - y, n.top + u + f + e > s && (l < 0 || l < t(s)) && (n.top += u + f + e)) : h > 0 && (c = n.top - i.collisionPosition.marginTop + u + f + e - o, n.top + u + f + e > h && (c > 0 || t(c) < h) && (n.top += u + f + e))
        }}, flipfit: {left: function () {
            n.ui.position.flip.left.apply(this, arguments);
            n.ui.position.fit.left.apply(this, arguments)
        }, top: function () {
            n.ui.position.flip.top.apply(this, arguments);
            n.ui.position.fit.top.apply(this, arguments)
        }}}, function () {
            var t, i, r, u, f, o = document.getElementsByTagName("body")[0], s = document.createElement("div");
            t = document.createElement(o ? "div" : "body");
            r = {visibility: "hidden", width: 0, height: 0, border: 0, margin: 0, background: "none"};
            o && n.extend(r, {position: "absolute", left: "-1000px", top: "-1000px"});
            for (f in r)t.style[f] = r[f];
            t.appendChild(s);
            i = o || document.documentElement;
            i.insertBefore(t, i.firstChild);
            s.style.cssText = "position: absolute; left: 10.7432222px;";
            u = n(s).offset().left;
            e = u > 10 && u < 11;
            t.innerHTML = "";
            i.removeChild(t)
        }()
    }();
    s = n.ui.position;
    h = n.widget("ui.menu", {version: "1.11.2", defaultElement: "<ul>", delay: 300, options: {icons: {submenu: "ui-icon-carat-1-e"}, items: "> *", menus: "ul", position: {my: "left-1 top", at: "right top"}, role: "menu", blur: null, focus: null, select: null}, _create: function () {
        this.activeMenu = this.element;
        this.mouseHandled = !1;
        this.element.uniqueId().addClass("ui-menu").toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length).attr({role: this.options.role, tabIndex: 0});
        this.options.disabled && this.element.addClass("ui-state-disabled").attr("aria-disabled", "true");
        this._on({"mousedown .ui-menu-item": function (n) {
            n.preventDefault()
        }, "click .ui-menu-item": function (t) {
            var i = n(t.target);
            !this.mouseHandled && i.not(".ui-state-disabled").length && (this.select(t), t.isPropagationStopped() || (this.mouseHandled = !0), i.has(".ui-menu").length ? this.expand(t) : !this.element.is(":focus") && n(this.document[0].activeElement).closest(".ui-menu").length && (this.element.trigger("focus", [!0]), this.active && this.active.parents(".ui-menu").length === 1 && clearTimeout(this.timer)))
        }, "mouseenter .ui-menu-item": function (t) {
            if (!this.previousFilter) {
                var i = n(t.currentTarget);
                i.siblings(".ui-state-active").removeClass("ui-state-active");
                this.focus(t, i)
            }
        }, mouseleave: "collapseAll", "mouseleave .ui-menu": "collapseAll", focus: function (n, t) {
            var i = this.active || this.element.find(this.options.items).eq(0);
            t || this.focus(n, i)
        }, blur: function (t) {
            this._delay(function () {
                n.contains(this.element[0], this.document[0].activeElement) || this.collapseAll(t)
            })
        }, keydown: "_keydown"});
        this.refresh();
        this._on(this.document, {click: function (n) {
            this._closeOnDocumentClick(n) && this.collapseAll(n);
            this.mouseHandled = !1
        }})
    }, _destroy: function () {
        this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-menu-icons ui-front").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show();
        this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").removeUniqueId().removeClass("ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function () {
            var t = n(this);
            t.data("ui-menu-submenu-carat") && t.remove()
        });
        this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content")
    }, _keydown: function (t) {
        var i, u, r, f, e = !0;
        switch (t.keyCode) {
            case n.ui.keyCode.PAGE_UP:
                this.previousPage(t);
                break;
            case n.ui.keyCode.PAGE_DOWN:
                this.nextPage(t);
                break;
            case n.ui.keyCode.HOME:
                this._move("first", "first", t);
                break;
            case n.ui.keyCode.END:
                this._move("last", "last", t);
                break;
            case n.ui.keyCode.UP:
                this.previous(t);
                break;
            case n.ui.keyCode.DOWN:
                this.next(t);
                break;
            case n.ui.keyCode.LEFT:
                this.collapse(t);
                break;
            case n.ui.keyCode.RIGHT:
                this.active && !this.active.is(".ui-state-disabled") && this.expand(t);
                break;
            case n.ui.keyCode.ENTER:
            case n.ui.keyCode.SPACE:
                this._activate(t);
                break;
            case n.ui.keyCode.ESCAPE:
                this.collapse(t);
                break;
            default:
                e = !1;
                u = this.previousFilter || "";
                r = String.fromCharCode(t.keyCode);
                f = !1;
                clearTimeout(this.filterTimer);
                r === u ? f = !0 : r = u + r;
                i = this._filterMenuItems(r);
                i = f && i.index(this.active.next()) !== -1 ? this.active.nextAll(".ui-menu-item") : i;
                i.length || (r = String.fromCharCode(t.keyCode), i = this._filterMenuItems(r));
                i.length ? (this.focus(t, i), this.previousFilter = r, this.filterTimer = this._delay(function () {
                    delete this.previousFilter
                }, 1e3)) : delete this.previousFilter
        }
        e && t.preventDefault()
    }, _activate: function (n) {
        this.active.is(".ui-state-disabled") || (this.active.is("[aria-haspopup='true']") ? this.expand(n) : this.select(n))
    }, refresh: function () {
        var i, t, u = this, f = this.options.icons.submenu, r = this.element.find(this.options.menus);
        this.element.toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length);
        r.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-front").hide().attr({role: this.options.role, "aria-hidden": "true", "aria-expanded": "false"}).each(function () {
            var t = n(this), i = t.parent(), r = n("<span>").addClass("ui-menu-icon ui-icon " + f).data("ui-menu-submenu-carat", !0);
            i.attr("aria-haspopup", "true").prepend(r);
            t.attr("aria-labelledby", i.attr("id"))
        });
        i = r.add(this.element);
        t = i.find(this.options.items);
        t.not(".ui-menu-item").each(function () {
            var t = n(this);
            u._isDivider(t) && t.addClass("ui-widget-content ui-menu-divider")
        });
        t.not(".ui-menu-item, .ui-menu-divider").addClass("ui-menu-item").uniqueId().attr({tabIndex: -1, role: this._itemRole()});
        t.filter(".ui-state-disabled").attr("aria-disabled", "true");
        this.active && !n.contains(this.element[0], this.active[0]) && this.blur()
    }, _itemRole: function () {
        return{menu: "menuitem", listbox: "option"}[this.options.role]
    }, _setOption: function (n, t) {
        n === "icons" && this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(t.submenu);
        n === "disabled" && this.element.toggleClass("ui-state-disabled", !!t).attr("aria-disabled", t);
        this._super(n, t)
    }, focus: function (n, t) {
        var i, r;
        this.blur(n, n && n.type === "focus");
        this._scrollIntoView(t);
        this.active = t.first();
        r = this.active.addClass("ui-state-focus").removeClass("ui-state-active");
        this.options.role && this.element.attr("aria-activedescendant", r.attr("id"));
        this.active.parent().closest(".ui-menu-item").addClass("ui-state-active");
        n && n.type === "keydown" ? this._close() : this.timer = this._delay(function () {
            this._close()
        }, this.delay);
        i = t.children(".ui-menu");
        i.length && n && /^mouse/.test(n.type) && this._startOpening(i);
        this.activeMenu = t.parent();
        this._trigger("focus", n, {item: t})
    }, _scrollIntoView: function (t) {
        var e, o, i, r, u, f;
        this._hasScroll() && (e = parseFloat(n.css(this.activeMenu[0], "borderTopWidth")) || 0, o = parseFloat(n.css(this.activeMenu[0], "paddingTop")) || 0, i = t.offset().top - this.activeMenu.offset().top - e - o, r = this.activeMenu.scrollTop(), u = this.activeMenu.height(), f = t.outerHeight(), i < 0 ? this.activeMenu.scrollTop(r + i) : i + f > u && this.activeMenu.scrollTop(r + i - u + f))
    }, blur: function (n, t) {
        (t || clearTimeout(this.timer), this.active) && (this.active.removeClass("ui-state-focus"), this.active = null, this._trigger("blur", n, {item: this.active}))
    }, _startOpening: function (n) {
        (clearTimeout(this.timer), n.attr("aria-hidden") === "true") && (this.timer = this._delay(function () {
            this._close();
            this._open(n)
        }, this.delay))
    }, _open: function (t) {
        var i = n.extend({of: this.active}, this.options.position);
        clearTimeout(this.timer);
        this.element.find(".ui-menu").not(t.parents(".ui-menu")).hide().attr("aria-hidden", "true");
        t.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i)
    }, collapseAll: function (t, i) {
        clearTimeout(this.timer);
        this.timer = this._delay(function () {
            var r = i ? this.element : n(t && t.target).closest(this.element.find(".ui-menu"));
            r.length || (r = this.element);
            this._close(r);
            this.blur(t);
            this.activeMenu = r
        }, this.delay)
    }, _close: function (n) {
        n || (n = this.active ? this.active.parent() : this.element);
        n.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find(".ui-state-active").not(".ui-state-focus").removeClass("ui-state-active")
    }, _closeOnDocumentClick: function (t) {
        return!n(t.target).closest(".ui-menu").length
    }, _isDivider: function (n) {
        return!/[^\-\u2014\u2013\s]/.test(n.text())
    }, collapse: function (n) {
        var t = this.active && this.active.parent().closest(".ui-menu-item", this.element);
        t && t.length && (this._close(), this.focus(n, t))
    }, expand: function (n) {
        var t = this.active && this.active.children(".ui-menu ").find(this.options.items).first();
        t && t.length && (this._open(t.parent()), this._delay(function () {
            this.focus(n, t)
        }))
    }, next: function (n) {
        this._move("next", "first", n)
    }, previous: function (n) {
        this._move("prev", "last", n)
    }, isFirstItem: function () {
        return this.active && !this.active.prevAll(".ui-menu-item").length
    }, isLastItem: function () {
        return this.active && !this.active.nextAll(".ui-menu-item").length
    }, _move: function (n, t, i) {
        var r;
        this.active && (r = n === "first" || n === "last" ? this.active[n === "first" ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[n + "All"](".ui-menu-item").eq(0));
        r && r.length && this.active || (r = this.activeMenu.find(this.options.items)[t]());
        this.focus(i, r)
    }, nextPage: function (t) {
        var i, r, u;
        if (!this.active) {
            this.next(t);
            return
        }
        this.isLastItem() || (this._hasScroll() ? (r = this.active.offset().top, u = this.element.height(), this.active.nextAll(".ui-menu-item").each(function () {
            return i = n(this), i.offset().top - r - u < 0
        }), this.focus(t, i)) : this.focus(t, this.activeMenu.find(this.options.items)[this.active ? "last" : "first"]()))
    }, previousPage: function (t) {
        var i, r, u;
        if (!this.active) {
            this.next(t);
            return
        }
        this.isFirstItem() || (this._hasScroll() ? (r = this.active.offset().top, u = this.element.height(), this.active.prevAll(".ui-menu-item").each(function () {
            return i = n(this), i.offset().top - r + u > 0
        }), this.focus(t, i)) : this.focus(t, this.activeMenu.find(this.options.items).first()))
    }, _hasScroll: function () {
        return this.element.outerHeight() < this.element.prop("scrollHeight")
    }, select: function (t) {
        this.active = this.active || n(t.target).closest(".ui-menu-item");
        var i = {item: this.active};
        this.active.has(".ui-menu").length || this.collapseAll(t, !0);
        this._trigger("select", t, i)
    }, _filterMenuItems: function (t) {
        var i = t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"), r = new RegExp("^" + i, "i");
        return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function () {
            return r.test(n.trim(n(this).text()))
        })
    }});
    n.widget("ui.autocomplete", {version: "1.11.2", defaultElement: "<input>", options: {appendTo: null, autoFocus: !1, delay: 300, minLength: 1, position: {my: "left top", at: "left bottom", collision: "none"}, source: null, change: null, close: null, focus: null, open: null, response: null, search: null, select: null}, requestIndex: 0, pending: 0, _create: function () {
        var t, i, r, u = this.element[0].nodeName.toLowerCase(), f = u === "textarea", e = u === "input";
        this.isMultiLine = f ? !0 : e ? !1 : this.element.prop("isContentEditable");
        this.valueMethod = this.element[f || e ? "val" : "text"];
        this.isNewMenu = !0;
        this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off");
        this._on(this.element, {keydown: function (u) {
            if (this.element.prop("readOnly")) {
                t = !0;
                r = !0;
                i = !0;
                return
            }
            t = !1;
            r = !1;
            i = !1;
            var f = n.ui.keyCode;
            switch (u.keyCode) {
                case f.PAGE_UP:
                    t = !0;
                    this._move("previousPage", u);
                    break;
                case f.PAGE_DOWN:
                    t = !0;
                    this._move("nextPage", u);
                    break;
                case f.UP:
                    t = !0;
                    this._keyEvent("previous", u);
                    break;
                case f.DOWN:
                    t = !0;
                    this._keyEvent("next", u);
                    break;
                case f.ENTER:
                    this.menu.active && (t = !0, u.preventDefault(), this.menu.select(u));
                    break;
                case f.TAB:
                    this.menu.active && this.menu.select(u);
                    break;
                case f.ESCAPE:
                    this.menu.element.is(":visible") && (this.isMultiLine || this._value(this.term), this.close(u), u.preventDefault());
                    break;
                default:
                    i = !0;
                    this._searchTimeout(u)
            }
        }, keypress: function (r) {
            if (t) {
                t = !1;
                (!this.isMultiLine || this.menu.element.is(":visible")) && r.preventDefault();
                return
            }
            if (!i) {
                var u = n.ui.keyCode;
                switch (r.keyCode) {
                    case u.PAGE_UP:
                        this._move("previousPage", r);
                        break;
                    case u.PAGE_DOWN:
                        this._move("nextPage", r);
                        break;
                    case u.UP:
                        this._keyEvent("previous", r);
                        break;
                    case u.DOWN:
                        this._keyEvent("next", r)
                }
            }
        }, input: function (n) {
            if (r) {
                r = !1;
                n.preventDefault();
                return
            }
            this._searchTimeout(n)
        }, focus: function () {
            this.selectedItem = null;
            this.previous = this._value()
        }, blur: function (n) {
            if (this.cancelBlur) {
                delete this.cancelBlur;
                return
            }
            clearTimeout(this.searching);
            this.close(n);
            this._change(n)
        }});
        this._initSource();
        this.menu = n("<ul>").addClass("ui-autocomplete").appendTo(this._appendTo()).menu({role: null}).hide().menu("instance");
        this._on(this.menu.element, {mousedown: function (t) {
            t.preventDefault();
            this.cancelBlur = !0;
            this._delay(function () {
                delete this.cancelBlur
            });
            var i = this.menu.element[0];
            n(t.target).closest(".ui-menu-item").length || this._delay(function () {
                var t = this;
                this.document.one("mousedown", function (r) {
                    r.target === t.element[0] || r.target === i || n.contains(i, r.target) || t.close()
                })
            })
        }, menufocus: function (t, i) {
            var r, u;
            if (this.isNewMenu && (this.isNewMenu = !1, t.originalEvent && /^mouse/.test(t.originalEvent.type))) {
                this.menu.blur();
                this.document.one("mousemove", function () {
                    n(t.target).trigger(t.originalEvent)
                });
                return
            }
            u = i.item.data("ui-autocomplete-item");
            !1 !== this._trigger("focus", t, {item: u}) && t.originalEvent && /^key/.test(t.originalEvent.type) && this._value(u.value);
            r = i.item.attr("aria-label") || u.value;
            r && n.trim(r).length && (this.liveRegion.children().hide(), n("<div>").text(r).appendTo(this.liveRegion))
        }, menuselect: function (n, t) {
            var i = t.item.data("ui-autocomplete-item"), r = this.previous;
            this.element[0] !== this.document[0].activeElement && (this.element.focus(), this.previous = r, this._delay(function () {
                this.previous = r;
                this.selectedItem = i
            }));
            !1 !== this._trigger("select", n, {item: i}) && this._value(i.value);
            this.term = this._value();
            this.close(n);
            this.selectedItem = i
        }});
        this.liveRegion = n("<span>", {role: "status", "aria-live": "assertive", "aria-relevant": "additions"}).addClass("ui-helper-hidden-accessible");
        this._on(this.window, {beforeunload: function () {
            this.element.removeAttr("autocomplete")
        }})
    }, _destroy: function () {
        clearTimeout(this.searching);
        this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete");
        this.menu.element.remove();
        this.liveRegion.remove()
    }, _setOption: function (n, t) {
        this._super(n, t);
        n === "source" && this._initSource();
        n === "appendTo" && this.menu.element.appendTo(this._appendTo());
        n === "disabled" && t && this.xhr && this.xhr.abort()
    }, _appendTo: function () {
        var t = this.options.appendTo;
        return t && (t = t.jquery || t.nodeType ? n(t) : this.document.find(t).eq(0)), t && t[0] || (t = this.element.closest(".ui-front")), t.length || (t = this.document[0].body), t
    }, _initSource: function () {
        var i, r, t = this;
        n.isArray(this.options.source) ? (i = this.options.source, this.source = function (t, r) {
            r(n.ui.autocomplete.filter(i, t.term))
        }) : typeof this.options.source == "string" ? (r = this.options.source, this.source = function (i, u) {
            t.xhr && t.xhr.abort();
            t.xhr = n.ajax({url: r, data: i, dataType: "json", success: function (n) {
                u(n)
            }, error: function () {
                u([])
            }})
        }) : this.source = this.options.source
    }, _searchTimeout: function (n) {
        clearTimeout(this.searching);
        this.searching = this._delay(function () {
            var t = this.term === this._value(), i = this.menu.element.is(":visible"), r = n.altKey || n.ctrlKey || n.metaKey || n.shiftKey;
            t && (!t || i || r) || (this.selectedItem = null, this.search(null, n))
        }, this.options.delay)
    }, search: function (n, t) {
        return(n = n != null ? n : this._value(), this.term = this._value(), n.length < this.options.minLength) ? this.close(t) : this._trigger("search", t) === !1 ? void 0 : this._search(n)
    }, _search: function (n) {
        this.pending++;
        this.element.addClass("ui-autocomplete-loading");
        this.cancelSearch = !1;
        this.source({term: n}, this._response())
    }, _response: function () {
        var t = ++this.requestIndex;
        return n.proxy(function (n) {
            t === this.requestIndex && this.__response(n);
            this.pending--;
            this.pending || this.element.removeClass("ui-autocomplete-loading")
        }, this)
    }, __response: function (n) {
        n && (n = this._normalize(n));
        this._trigger("response", null, {content: n});
        !this.options.disabled && n && n.length && !this.cancelSearch ? (this._suggest(n), this._trigger("open")) : this._close()
    }, close: function (n) {
        this.cancelSearch = !0;
        this._close(n)
    }, _close: function (n) {
        this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", n))
    }, _change: function (n) {
        this.previous !== this._value() && this._trigger("change", n, {item: this.selectedItem})
    }, _normalize: function (t) {
        return t.length && t[0].label && t[0].value ? t : n.map(t, function (t) {
            return typeof t == "string" ? {label: t, value: t} : n.extend({}, t, {label: t.label || t.value, value: t.value || t.label})
        })
    }, _suggest: function (t) {
        var i = this.menu.element.empty();
        this._renderMenu(i, t);
        this.isNewMenu = !0;
        this.menu.refresh();
        i.show();
        this._resizeMenu();
        i.position(n.extend({of: this.element}, this.options.position));
        this.options.autoFocus && this.menu.next()
    }, _resizeMenu: function () {
        var n = this.menu.element;
        n.outerWidth(Math.max(n.width("").outerWidth() + 1, this.element.outerWidth()))
    }, _renderMenu: function (t, i) {
        var r = this;
        n.each(i, function (n, i) {
            r._renderItemData(t, i)
        })
    }, _renderItemData: function (n, t) {
        return this._renderItem(n, t).data("ui-autocomplete-item", t)
    }, _renderItem: function (t, i) {
        return n("<li>").text(i.label).appendTo(t)
    }, _move: function (n, t) {
        if (!this.menu.element.is(":visible")) {
            this.search(null, t);
            return
        }
        if (this.menu.isFirstItem() && /^previous/.test(n) || this.menu.isLastItem() && /^next/.test(n)) {
            this.isMultiLine || this._value(this.term);
            this.menu.blur();
            return
        }
        this.menu[n](t)
    }, widget: function () {
        return this.menu.element
    }, _value: function () {
        return this.valueMethod.apply(this.element, arguments)
    }, _keyEvent: function (n, t) {
        (!this.isMultiLine || this.menu.element.is(":visible")) && (this._move(n, t), t.preventDefault())
    }});
    n.extend(n.ui.autocomplete, {escapeRegex: function (n) {
        return n.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
    }, filter: function (t, i) {
        var r = new RegExp(n.ui.autocomplete.escapeRegex(i), "i");
        return n.grep(t, function (n) {
            return r.test(n.label || n.value || n)
        })
    }});
    n.widget("ui.autocomplete", n.ui.autocomplete, {options: {messages: {noResults: "No search results.", results: function (n) {
        return n + (n > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate."
    }}}, __response: function (t) {
        var i;
        (this._superApply(arguments), this.options.disabled || this.cancelSearch) || (i = t && t.length ? this.options.messages.results(t.length) : this.options.messages.noResults, this.liveRegion.children().hide(), n("<div>").text(i).appendTo(this.liveRegion))
    }});
    c = n.ui.autocomplete
});

