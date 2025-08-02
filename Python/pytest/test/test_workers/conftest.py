import pytest

count = 1

@pytest.fixture(autouse=True)
def clean_test_file():
    global count
    with open("./test/test_prodfile.txt","w"):
        pass
    print(count)
    count += 1