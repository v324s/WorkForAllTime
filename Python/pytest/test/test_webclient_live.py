from webclient_live import ResourceClient
import responses
from datetime import datetime
import pytest

@responses.activate
def test_webclient_live():
    valid_json_answer = {
        "lastActionTime": 1454126322,
        "timeDiff": 18567
    }
    testAnswer = datetime.fromtimestamp(valid_json_answer["lastActionTime"] - valid_json_answer["timeDiff"])

    responses.add(
        method = responses.GET, 
        url = "https://www.avito.ru/web/2/user/get-status/0d3183c17f3d715f19be7b5c91f47ba8", 
        json = valid_json_answer, 
        status = 200
    )

    rclient = ResourceClient("https://www.avito.ru")
    res = rclient.get_user_last_action_time("0d3183c17f3d715f19be7b5c91f47ba8")
    print(testAnswer)
    assert res == testAnswer



@responses.activate
def test_webclient_live_error():
    valid_json_answer = {
        "errors": [
            "Not found"
        ]
    }

    responses.add(
        method = responses.GET, 
        url = "https://www.avito.ru/web/2/user/get-status/0d3183c17f3d715f19be7b5c91f47ba8+", 
        json = valid_json_answer, 
        status = 404
    )

    with pytest.raises(KeyError):
        rclient = ResourceClient("https://www.avito.ru")
        res = rclient.get_user_last_action_time("0d3183c17f3d715f19be7b5c91f47ba8+")