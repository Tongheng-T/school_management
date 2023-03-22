(() => {
  "use strict";
  var e = {
    n: (t) => {
      var r = t && t.__esModule ? () => t.default : () => t;
      return e.d(r, { a: r }), r;
    },
    d: (t, r) => {
      for (var n in r)
        e.o(r, n) &&
          !e.o(t, n) &&
          Object.defineProperty(t, n, { enumerable: !0, get: r[n] });
    },
    o: (e, t) => Object.prototype.hasOwnProperty.call(e, t),
  };
  const t = jQuery;
  var r = e.n(t);
  function n(e) {
    for (var t, r = [], n = /{([^}]+)}/gi; null != (t = n.exec(e)); ) {
      var a = { eqName: t[1], fieldName: t[1], reactive: !0 };
      "!" === a.fieldName[0] &&
        ((a.reactive = !1), (a.fieldName = a.fieldName.substr(1))),
        r.push(a);
    }
    return r;
  }
  function a(e) {
    return /^[a-zA-Z].*/.test(e) ? ':input[name="' + e + '"]' : e;
  }
  function o(e, t, n) {
    for (
      var a = e + "",
        o = t.decimalOpts.concat(t.thousandOpts),
        c = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "-"],
        s = "",
        i = "",
        u = "",
        f = -1,
        l = "",
        g = "",
        d = -1,
        p = 0,
        h = a.length - 1;
      h >= 0;
      h--
    )
      (i = a.charAt(h)),
        -1 != r().inArray(i, c)
          ? (s = i + s)
          : "" == u && -1 != r().inArray(i, t.decimalOpts)
          ? ((f = h), (u = i), (s = "." + s))
          : "" == l && -1 != r().inArray(i, t.thousandOpts)
          ? (l = i)
          : "" != g ||
            -1 != r().inArray(i, o) ||
            (0 != h && h != a.length - 1) ||
            ((g = i), (d = h));
    return (
      "" != u && ((p = a.length - f - 1), d > f && p--),
      -1 != t.decimalPlaces && (p = t.decimalPlaces),
      3 === arguments.length &&
        ("" == n.dec && "" != u && (n.dec = u),
        ((-1 == n.decPlaces && -1 != p) ||
          (-1 != n.decPlaces && -1 != p && p < n.decPlaces)) &&
          (n.decPlaces = p),
        "" == n.thou && "" != l && (n.thou = l),
        "" == n.sym && "" != g && ((n.sym = g), (n.symLoc = d))),
      t.emptyAsZero && "" == s && (s = "0"),
      s
    );
  }
  var c = {
      "+": {
        op: "+",
        precedence: 10,
        assoc: "L",
        exec: function (e, t) {
          return e + t;
        },
      },
      "-": {
        op: "-",
        precedence: 10,
        assoc: "L",
        exec: function (e, t) {
          return e - t;
        },
      },
      "*": {
        op: "*",
        precedence: 20,
        assoc: "L",
        exec: function (e, t) {
          return e * t;
        },
      },
      "/": {
        op: "/",
        precedence: 20,
        assoc: "L",
        exec: function (e, t) {
          return e / t;
        },
      },
      "**": {
        op: "**",
        precedence: 30,
        assoc: "R",
        exec: function (e, t) {
          return Math.pow(e, t);
        },
      },
    },
    s = { e: Math.exp(1), pi: 4 * Math.atan2(1, 1) };
  function i(e) {
    var t,
      r,
      n = e.offset;
    for (
      t = 0;
      "0123456789".indexOf(e.string.substr(e.offset, 1)) >= 0 &&
      e.offset < e.string.length;

    )
      e.offset++;
    if ("." == e.string.substr(e.offset, 1))
      for (
        e.offset++;
        "0123456789".indexOf(e.string.substr(e.offset, 1)) >= 0 &&
        e.offset < e.string.length;

      )
        e.offset++;
    if (e.offset > n) return parseFloat(e.string.substr(n, e.offset - n));
    if ("+" == e.string.substr(e.offset, 1)) return e.offset++, i(e);
    if ("-" == e.string.substr(e.offset, 1))
      return (
        e.offset++,
        (function (e) {
          return -e;
        })(i(e))
      );
    if ("(" == e.string.substr(e.offset, 1)) {
      if ((e.offset++, (t = f(e)), ")" == e.string.substr(e.offset, 1)))
        return e.offset++, t;
      throw (
        ((e.error = "Parsing error: ')' expected"), new Error("parseError"))
      );
    }
    if (null != (r = /^[a-z_][a-z0-9_]*/i.exec(e.string.substr(e.offset)))) {
      var a = r[0];
      if (((e.offset += a.length), a in s)) return s[a];
      throw (
        ((e.error = "Semantic error: unknown variable '" + a + "'"),
        new Error("unknownVar"))
      );
    }
    throw e.string.length == e.offset
      ? ((e.error = "Parsing error at end of string: value expected"),
        new Error("valueMissing"))
      : ((e.error = "Parsing error: unrecognized value"),
        new Error("valueNotParsed"));
  }
  function u(e) {
    return "**" == e.string.substr(e.offset, 2)
      ? ((e.offset += 2), c["**"])
      : "+-*/".indexOf(e.string.substr(e.offset, 1)) >= 0
      ? c[e.string.substr(e.offset++, 1)]
      : null;
  }
  function f(e) {
    for (var t = [{ precedence: 0, assoc: "L" }], r = i(e); ; ) {
      for (
        var n = u(e) || { precedence: 0, assoc: "L" };
        n.precedence < t[t.length - 1].precedence ||
        (n.precedence == t[t.length - 1].precedence && "L" == n.assoc);

      ) {
        var a = t.pop();
        if (!a.exec) return r;
        r = a.exec(a.value, r);
      }
      t.push({
        op: n.op,
        precedence: n.precedence,
        assoc: n.assoc,
        exec: n.exec,
        value: r,
      }),
        (r = i(e));
    }
  }
  function l(e, t) {
    var r = { string: e, offset: 0 };
    try {
      var n = f(r);
      if (r.offset < r.string.length)
        throw (
          ((r.error = "Syntax error: junk found at offset " + r.offset),
          new Error("trailingJunk"))
        );
      return n;
    } catch (e) {
      return (
        t.showParseError &&
          alert(
            ""
              .concat(r.error, " (")
              .concat(e, "):\n")
              .concat(r.string.substr(0, r.offset), "<*>")
              .concat(r.string.substr(r.offset))
          ),
        null
      );
    }
  }
  function g(e, t, r, n, c, s, i) {
    var u = "",
      f = { dec: "", decPlaces: -1, thou: "", sym: "", symLoc: -1 };
    $.each($.extend({}, i), function (t, r) {
      for (var a, o = new RegExp(r.rgx, "gi"); null != (a = o.exec(e)); ) {
        var s = r.exec(a[1], n, c, f);
        e = e.replace(new RegExp(r.rgx, "gi"), s);
      }
    });
    for (var g = 0; g < t.length; g++) {
      var d = t[g],
        p = o($(a(d.fieldName), n).val(), c, f);
      if (0 == p.length) return void r.val("").trigger("change");
      if (null == l(p, { showParseError: !1 }))
        return void r.val("").trigger("change");
      e = e.replace(new RegExp("{" + d.eqName + "}", "g"), p);
    }
    (e = e.replace(/ /g, "")),
      "" == f.dec && (f.dec = c.decimalOpts[0]),
      -1 == f.decPlaces && (f.decPlaces = 0),
      "" == f.thou && (f.thou = c.thousandOpts[0]);
    var h = l(e, c);
    if (
      ((u = (u = (u = (u = (u =
        null == h
          ? ""
          : (function (e, t) {
              for (
                var r = (e.toFixed(t) + "").split("."),
                  n = r.length > 1 ? "." + r[1] : "",
                  a = /(\d+)(\d{3})/,
                  o = r[0];
                a.test(o);

              )
                o = o.replace(a, "$1,$2");
              return o + n;
            })(h, f.decPlaces)).replace(/\./g, "<c>")).replace(
        /\,/g,
        "<t>"
      )).replace(/<c>/g, f.dec)).replace(/<t>/g, f.thou)),
      f.symLoc > -1 && (0 == f.symLoc ? (u = f.sym + u) : (u += f.sym)),
      c.smartIntegers && (u = u.replace(/[\,\.]0+$/, "")),
      "function" == typeof c.onShowResult && (u = c.onShowResult.call(r, u)),
      r.val(u),
      c.chainFire)
    ) {
      var v = r.data("current");
      (void 0 !== v && v === u) || (r.data("current", u), r.trigger("change"));
    }
  }
  var d = "jautocalc",
    p = "_jautocalc",
    h = "focus change blur";
  function v(e, t, r, o) {
    return e.each(function () {
      var e = $(this);
      $("[" + t.attribute + "]:not([" + p + "])", e).each(function () {
        var c = $(this),
          s = c.attr(t.attribute),
          i = n(s);
        if (0 != i.length) {
          for (var u = 0; u < i.length; u++)
            if (0 == $(a(i[u].fieldName), e).length) return;
          t.keyEventsFire && (h += " keyup keydown keypress");
          for (
            var f = h
                .split(" ")
                .map(function (e) {
                  return "".concat(e, ".").concat(d);
                })
                .join(".jautocalc "),
              l = 0;
            l < i.length;
            l++
          ) {
            var v = i[l];
            !1 !== v.reactive &&
              $(a(v.fieldName), e).on(
                f,
                {
                  equation: s,
                  equationFields: i,
                  result: c,
                  context: e,
                  opts: t,
                  vars: r,
                  funcs: o,
                },
                function (e) {
                  g(
                    e.data.equation,
                    e.data.equationFields,
                    e.data.result,
                    e.data.context,
                    e.data.opts,
                    e.data.vars,
                    e.data.funcs
                  );
                }
              );
          }
          t.readOnlyResults && c.attr("readonly", "readonly"),
            c.attr(p, p),
            t.initFire && $(a(i[0].fieldName), e).trigger("change");
        }
      });
    });
  }
  function m(e, t) {
    return e.each(function () {
      var e = $(this);
      $("[" + t.attribute + "][" + p + "]", e).each(function () {
        var r = $(this),
          o = n(r.attr(t.attribute));
        if (0 != o.length) {
          for (var c = 0; c < o.length; c++) {
            var s = o[c];
            $(a(s.fieldName), e).off(".jautocalc");
          }
          t.readOnlyResults && r.removeAttr("readonly"), r.removeAttr(p);
        }
      });
    });
  }
  var y = {
    sum: {
      rgx: "sum\\({([^}]+)}\\)",
      exec: function (e, t, n, c) {
        var s = 0;
        return (
          r()(a(e), t).each(function () {
            var e = parseFloat(o(r()(this).val(), n, c));
            s += e;
          }),
          s
        );
      },
    },
    avg: {
      rgx: "avg\\({([^}]+)}\\)",
      exec: function (e, t, n, c) {
        var s = 0,
          i = r()(a(e), t).each(function () {
            var e = parseFloat(o(r()(this).val(), n, c));
            s += e;
          }).length;
        return s / i;
      },
    },
    min: {
      rgx: "min\\({([^}]+)}\\)",
      exec: function (e, t, n, c) {
        return Math.min.apply(
          this,
          r()(a(e), t)
            .map(function (e, t) {
              return o(r()(t).val(), n, c);
            })
            .get()
        );
      },
    },
    max: {
      rgx: "max\\({([^}]+)}\\)",
      exec: function (e, t, n, c) {
        return Math.max.apply(
          this,
          r()(a(e), t)
            .map(function (e, t) {
              return o(r()(t).val(), n, c);
            })
            .get()
        );
      },
    },
    count: {
      rgx: "count\\({([^}]+)}\\)",
      exec: function (e, t) {
        return r()(a(e), t).length;
      },
    },
    countNotEmpty: {
      rgx: "countNotEmpty\\({([^}]+)}\\)",
      exec: function (e, t) {
        return r().grep(r()(a(e), t), function (e) {
          return (r()(e).val() + "").length > 0;
        }).length;
      },
    },
  };
  function x(e) {
    return (
      (x =
        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
          ? function (e) {
              return typeof e;
            }
          : function (e) {
              return e &&
                "function" == typeof Symbol &&
                e.constructor === Symbol &&
                e !== Symbol.prototype
                ? "symbol"
                : typeof e;
            }),
      x(e)
    );
  }
  r().fn.jAutoCalc = Object.assign(
    function () {
      for (
        var e = "init",
          t = r().extend({}, r().fn.jAutoCalc.defaults),
          n = { init: v, destroy: m },
          a = arguments.length,
          o = new Array(a),
          c = 0;
        c < a;
        c++
      )
        o[c] = arguments[c];
      for (var i = 0, u = o; i < u.length; i++) {
        var f = u[i];
        "string" == typeof f && (e = f.toString()),
          "object" === x(f) && (t = r().extend(t, f));
      }
      var l = r().extend({}, y, t.funcs),
        g = r().extend([], s, t.vars);
      return n[e] ? n[e](this, t, g, l) : v(this, t, g, l);
    },
    {
      defaults: {
        attribute: "jAutoCalc",
        thousandOpts: [""], 
        // thousandOpts: [",", ".", " "],
        decimalOpts: [".", ","],
        decimalPlaces: -1,
        initFire: !0,
        chainFire: !0,
        keyEventsFire: !1,
        readOnlyResults: !0,
        showParseError: !0,
        emptyAsZero: !1,
        smartIntegers: !1,
        onShowResult: null,
        funcs: {},
        vars: {},
      },
    }
  );
})();
//# sourceMappingURL=jautocalc.js.map
