import pytest

from calc import simple_calc

def test_simple_calc_plus():
    result = simple_calc(3,3,"+")
    assert result == 6

def test_simple_calc_minus():
    result = simple_calc(3,3,"-")
    assert result == 0

def test_simple_calc_div():
    result = simple_calc(3,3,"/")
    assert result == 1

def test_simple_calc_mul():
    result = simple_calc(3,3,"*")
    assert result == 9





def test_simple_calc():
    pairs_for_testing = (
        (
            "+", 6
        ),
        (
            "-", 0
        ),
        (
            "/", 1
        ),
        (
            "*", 9
        )
    )
    for operation, expected_result in pairs_for_testing:
        result = simple_calc(3, 3, operation)
        assert result == expected_result




@pytest.mark.parametrize("operation, expected_result", [
    (
        "+", 6
    ),
    (
        "-", 0
    ),
    (
        "/", 1
    ),
    (
        "*", 9
    )
])
def test_simple_calc_parametrize(operation, expected_result):
    result = simple_calc(3, 3, operation)
    assert result == expected_result
