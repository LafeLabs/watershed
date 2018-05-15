import numpy as np
import sys
from scipy.optimize import curve_fit

derp  = sys.argv[1]
foo = derp.split();
tn = float(foo[0])
t = float(foo[1])
g = float(foo[2])
f = float(foo[3])

def fitfunc(x, tn, t, g,f):
    xplus = (x + 0.0000000001 + f)/(2*t)
    xminus = (x + 0.0000000001 - f)/(2*t)
    return g*(tn + t*(xplus/np.tanh(xplus)) + t*(xminus/np.tanh(xminus)))
    
xdata = np.linspace(-20, 20, 99)
y = fitfunc(xdata, 1, 0.5, 1, 6)

popt, pcov = curve_fit(fitfunc, xdata, ydata)

