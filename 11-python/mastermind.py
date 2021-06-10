#!/usr/bin/python
print("Content-type: text/html\n\n")

# Code from below onwards
import cgi
form = cgi.FieldStorage()

print("<h1>Mastermind!</h1>")
