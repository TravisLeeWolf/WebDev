#!/usr/bin/python
print("Content-type: text/html\n\n")

# Code from below onwards
import cgi
import random
form = cgi.FieldStorage()

# Global variables
# reds and whites indicate correct or incorrect guesses
reds = 0
whites = 0

# Generate a random number answer and store as a string
if "answer" in form:
    answer = form.getvalue("answer")
else:
    answer = ""
    for i in range(4):
        answer += str(random.randint(0,9))

# Display guess in input
if "guess" in form:
    guess = form.getvalue("guess")
    # Logic to the game, comparing inputs
    for key, digit in enumerate(guess): # This allows us to both get the location and value in guess
        if digit == answer[key]:
            reds += 1
        else:
            for answerDigit in answer:
                if answerDigit == digit:
                    whites =+ 1
                    break # A break is used so it only counts once
else:
    guess = ""

# Count the number of guesses
if "numberOfGuesses" in form:
    numberOfGuesses = int(form.getvalue("numberOfGuesses")) + 1
else:
    numberOfGuesses = 0

# Change the message according to if the user has made a guess as yet
if numberOfGuesses == 0:
    message = "<h3>I've chosen a 4 digit number. Can you guess it?</h3>"
# Message for when the player gets it right
elif reds == 4:
    message = "<h2>Well done! You got it in " + str(numberOfGuesses) + " guesses. <a href=''>Play Again</a></h2>" # href reloads the page to start the game again
else:
    message = "<h3>You have " + str(reds) + " correct digit(s) in the right place, and " + str(whites) + " correct digit(s) in the wrong place. You have made " + str(numberOfGuesses) + " guess(es).</h3>"

"""
# For debugging
print(answer)
print
print(reds)
print(whites)
"""
print("<title>Mastermind</title>")
print("<h1>Mastermind!</h1>")
print("<p>This is a simple game of Mastermind using Python in the backend.</p>")
print("<hr>")
print("<br>")
# Game message to be displayed before and while playing the game
print(message)
# Form to get the users input
# Form method is set to post to correctly hide the inputs that will be hidden
print("<form method='post'>")
print("<input type='text' name='guess' value='" + guess + "'>")
# Hidden input to keep answer persistant
print("<input type='hidden' name='answer' value='" + answer +"'>")
# Hidden input to count the number of guesses
print("<input type='hidden' name='numberOfGuesses' value='" + str(numberOfGuesses) + "'>")
print("<input type='submit' value='Guess!'>")
print("</form>")

