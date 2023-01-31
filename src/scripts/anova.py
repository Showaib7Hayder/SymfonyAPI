import pandas as pd
from scipy import stats
import sys


data = pd.read_csv("C:/xampp/htdocs/symfonyApp/backEndSymfony/src/sets/Maths.csv")
variables = sys.argv[1:]
var1 = variables[0]
var2 = variables[1]

males_Info = data[data[var1] == 'M']
Males = males_Info[[var1,var2]]

females_Info = data[data[var1] == 'F']
Females = females_Info[[var1,var2]]

malesAge = Males[[var2]]
femalesAge = Females[[var2]]

F, P = stats.f_oneway(malesAge, femalesAge)
print(F,P)