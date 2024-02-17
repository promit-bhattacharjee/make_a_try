import sys
import cv2 as cv 
def encoding(path):
    img = cv.imread(path)
    encoding_value = img
    return encoding_value
filePath =sys.argv[1]
encodings = encoding(filePath)
print(encodings)
