from src.workers import read_from_file
import pytest


def create_testdata(test_data):
    with open("./test/test_prodfile.txt","a") as f_o:
        f_o.writelines(test_data)

def test_read_from_file():
    test_data = ['one\n','two\n','three\n']
    create_testdata(test_data)
    assert test_data == read_from_file("./test/test_prodfile.txt")

def test_read_from_file2():
    test_data = ['one\n','two\n','three\n','four\n']
    create_testdata(test_data)
    assert test_data == read_from_file("./test/test_prodfile.txt")