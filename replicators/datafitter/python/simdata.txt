import numpy as np
import sys
from scipy.optimize import curve_fit

derp  = sys.argv[1]
foo = derp.split();
tn = float(foo[0])
t = float(foo[1])
g = float(foo[2])
f = float(foo[3])


def func2(x, tn, t, g,f):
    xplus = (x + 0.0000000001 + f)/(2*t)
    xminus = (x + 0.0000000001 - f)/(2*t)
    return g*(tn + t*(xplus/np.tanh(xplus)) + t*(xminus/np.tanh(xminus)))

xdata = np.linspace(-20, 20, 99)
y = func2(xdata, tn, t, g, f)
np.random.seed(1729)
y_noise = 0.2 * np.random.normal(size=xdata.size)
ydata = y + y_noise

for index in range(len(ydata)):
    print(str(ydata[index]))
