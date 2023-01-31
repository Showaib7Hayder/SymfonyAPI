import pandas as pd
from scipy.stats import shapiro
import sys


data = pd.read_csv("C:/xampp/htdocs/symfonyApp/backEndSymfony/src/sets/Maths.csv")
variables = sys.argv[1:]

var1 = data[variables[0]]

shapiro = shapiro(var1)
print(shapiro)
