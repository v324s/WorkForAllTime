from typing import Union

def simple_calc(num_1: Union[float,int], num_2: Union[float,int], operation: str) -> Union[float, int]:
    if operation == "/":
        return num_1 / num_2
    elif operation == "*":
        return num_1 * num_2
    elif operation == "+":
        return num_1 + num_2
    elif operation == "-":
        return num_1 - num_2
    