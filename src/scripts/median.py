import pandas as pd
import sys


data = pd.read_csv("C:/xampp/htdocs/symfonyApp/backEndSymfony/src/sets/Maths.csv")
variables = sys.argv[1:]

age = data[variables[0]]

age_median = age.median()

print("Age Median is " , age_median)