#!/usr/bin/env python3
"""
CSS color filter generator — port of github.com/angel-rs/css-color-filter-generator
Uso: python3 css-filter.py "#D43900"
     python3 css-filter.py "#D43900" "#00595D" "#004E4D"
"""

import math, random, sys


class Color:
    def __init__(self, r, g, b):
        self.r = self._clamp(r)
        self.g = self._clamp(g)
        self.b = self._clamp(b)

    def set(self, r, g, b):
        self.r = self._clamp(r)
        self.g = self._clamp(g)
        self.b = self._clamp(b)

    def _clamp(self, v):
        return max(0.0, min(255.0, v))

    def _multiply(self, m):
        r = self._clamp(self.r * m[0] + self.g * m[1] + self.b * m[2])
        g = self._clamp(self.r * m[3] + self.g * m[4] + self.b * m[5])
        b = self._clamp(self.r * m[6] + self.g * m[7] + self.b * m[8])
        self.r, self.g, self.b = r, g, b

    def invert(self, v=1):
        self.r = self._clamp((v + (self.r / 255) * (1 - 2 * v)) * 255)
        self.g = self._clamp((v + (self.g / 255) * (1 - 2 * v)) * 255)
        self.b = self._clamp((v + (self.b / 255) * (1 - 2 * v)) * 255)

    def sepia(self, v=1):
        self._multiply([
            0.393 + 0.607*(1-v), 0.769 - 0.769*(1-v), 0.189 - 0.189*(1-v),
            0.349 - 0.349*(1-v), 0.686 + 0.314*(1-v), 0.168 - 0.168*(1-v),
            0.272 - 0.272*(1-v), 0.534 - 0.534*(1-v), 0.131 + 0.869*(1-v),
        ])

    def saturate(self, v=1):
        self._multiply([
            0.213 + 0.787*v, 0.715 - 0.715*v, 0.072 - 0.072*v,
            0.213 - 0.213*v, 0.715 + 0.285*v, 0.072 - 0.072*v,
            0.213 - 0.213*v, 0.715 - 0.715*v, 0.072 + 0.928*v,
        ])

    def hue_rotate(self, angle=0):
        a = angle * math.pi / 180
        s, c = math.sin(a), math.cos(a)
        self._multiply([
            0.213 + c*0.787 - s*0.213, 0.715 - c*0.715 - s*0.715, 0.072 - c*0.072 + s*0.928,
            0.213 - c*0.213 + s*0.143, 0.715 + c*0.285 + s*0.140, 0.072 - c*0.072 - s*0.283,
            0.213 - c*0.213 - s*0.787, 0.715 - c*0.715 + s*0.715, 0.072 + c*0.928 + s*0.072,
        ])

    def brightness(self, v=1):
        self.r = self._clamp(self.r * v)
        self.g = self._clamp(self.g * v)
        self.b = self._clamp(self.b * v)

    def contrast(self, v=1):
        self.r = self._clamp(self.r * v + (-0.5*v + 0.5) * 255)
        self.g = self._clamp(self.g * v + (-0.5*v + 0.5) * 255)
        self.b = self._clamp(self.b * v + (-0.5*v + 0.5) * 255)

    def hsl(self):
        r, g, b = self.r/255, self.g/255, self.b/255
        mx, mn = max(r,g,b), min(r,g,b)
        l = (mx + mn) / 2
        if mx == mn:
            h = s = 0.0
        else:
            d = mx - mn
            s = d / (2 - mx - mn) if l > 0.5 else d / (mx + mn)
            if mx == r:   h = (g - b) / d + (6 if g < b else 0)
            elif mx == g: h = (b - r) / d + 2
            else:         h = (r - g) / d + 4
            h /= 6
        return h*100, s*100, l*100


class Solver:
    def __init__(self, target: Color):
        self.target = target
        self.target_hsl = target.hsl()
        self._buf = Color(0, 0, 0)

    def loss(self, f):
        c = self._buf
        c.set(0, 0, 0)
        c.invert(f[0]/100)
        c.sepia(f[1]/100)
        c.saturate(f[2]/100)
        c.hue_rotate(f[3]*3.6)
        c.brightness(f[4]/100)
        c.contrast(f[5]/100)
        ch, cs, cl = c.hsl()
        th, ts, tl = self.target_hsl
        return (abs(c.r - self.target.r) + abs(c.g - self.target.g) + abs(c.b - self.target.b)
                + abs(ch - th) + abs(cs - ts) + abs(cl - tl))

    def _fix(self, v, idx):
        mx = 7500 if idx == 2 else (200 if idx in (4, 5) else 100)
        if idx == 3:  # hue-rotate wraps
            v = v % 360 if v > 360 else (360 + v % 360 if v < 0 else v)
        else:
            v = max(0, min(mx, v))
        return v

    def _spsa(self, A, a, c, values, iters):
        alpha, gamma = 1.0, 1/6
        best, best_loss = None, float('inf')
        deltas = [0]*6; hi = [0]*6; lo = [0]*6
        for k in range(iters):
            ck = c / (k+1)**gamma
            for i in range(6):
                deltas[i] = 1 if random.random() > 0.5 else -1
                hi[i] = values[i] + ck*deltas[i]
                lo[i] = values[i] - ck*deltas[i]
            loss_diff = self.loss(hi) - self.loss(lo)
            for i in range(6):
                g = (loss_diff / (2*ck)) * deltas[i]
                ak = a[i] / (A + k + 1)**alpha
                values[i] = self._fix(values[i] - ak*g, i)
            l = self.loss(values)
            if l < best_loss:
                best, best_loss = values[:], l
        return best, best_loss

    def solve(self):
        # Wide pass
        A, c = 5, 15
        a_wide = [60, 180, 18000, 600, 1.2, 1.2]
        best_vals, best_loss = None, float('inf')
        for _ in range(3):
            if best_loss <= 25:
                break
            vals, loss = self._spsa(A, a_wide, c, [50,20,3750,50,100,100], 1000)
            if loss < best_loss:
                best_vals, best_loss = vals, loss

        # Narrow pass
        A2 = best_loss
        a_narrow = [0.25*(A2+1), 0.25*(A2+1), A2+1, 0.25*(A2+1), 0.2*(A2+1), 0.2*(A2+1)]
        vals, loss = self._spsa(A2, a_narrow, 2, best_vals, 500)
        return vals, loss

    def css(self, f):
        def fmt(i, mul=1): return round(f[i] * mul)
        return (f"brightness(0) saturate(100%) invert({fmt(0)}%) sepia({fmt(1)}%) "
                f"saturate({fmt(2)}%) hue-rotate({fmt(3,3.6)}deg) "
                f"brightness({fmt(4)}%) contrast({fmt(5)}%)")


def hex_to_rgb(h):
    h = h.lstrip('#')
    if len(h) == 3:
        h = ''.join(c*2 for c in h)
    return int(h[0:2],16), int(h[2:4],16), int(h[4:6],16)


if __name__ == '__main__':
    hexes = sys.argv[1:] if len(sys.argv) > 1 else ['#004E4D','#00595D','#D43900','#FFB4A3','#3E4948']
    for hex_val in hexes:
        r, g, b = hex_to_rgb(hex_val)
        color = Color(r, g, b)
        solver = Solver(color)
        vals, loss = solver.solve()
        css = solver.css(vals)
        quality = "perfeito" if loss < 1 else "ótimo" if loss < 5 else "bom" if loss < 15 else "ruim — rode novamente"
        print(f"{hex_val}  loss={loss:.1f} ({quality})")
        print(f"  filter: {css};")
        print()
