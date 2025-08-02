import requests
import json
from datetime import datetime

class ResourceClient:
    def __init__(self, url):
        self.url = url

    def __user_get_status(self, uid):
        res = requests.get(f"{self.url}/web/2/user/get-status/{uid}")
        json_data = json.loads(res.text)
        return json_data

    def get_user_last_action_time(self, uid):
        json_data = self.__user_get_status(uid)
        last_action_time = json_data['lastActionTime']
        time_diff = json_data['timeDiff']
        return datetime.fromtimestamp(last_action_time - time_diff)

# если запускается не из вне:
if __name__ == "__main__":
    rclient = ResourceClient("https://www.avito.ru")
    print(rclient.get_user_last_action_time("0d3183c17f3d715f19be7b5c91f47ba8"))