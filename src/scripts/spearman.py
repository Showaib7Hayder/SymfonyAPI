import pandas as pd
from scipy.stats import spearmanr
import sys


data = pd.read_csv("C:/xampp/htdocs/symfonyApp/backEndSymfony/src/sets/Maths.csv")
variables = sys.argv[1:]

var1 = variables[0]
var2 = variables[1]


coef , p = spearmanr(data[var1],data[var2])

print('Spearmans correlation coefficient: ' , coef)
print('P value : ' , p)