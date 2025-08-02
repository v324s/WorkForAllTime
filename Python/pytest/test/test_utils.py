from utils import devision
from contextlib import nullcontext as does_not_raise
import pytest

@pytest.mark.parametrize(
    "a, b, res, exp",
    [
        (10, 2, 5, does_not_raise()),
        (20, 10, 2, does_not_raise()),
        (30, -3, -10, does_not_raise()),
        (5, 2, 2.5, does_not_raise()),
        (10, 0, None, pytest.raises(ZeroDivisionError)),
        (5, "1", None, pytest.raises(TypeError))
    ]
)
def test_devision(a, b, res, exp):
    with exp:
        devision(a,b) == res