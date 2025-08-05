from abc import ABC, abstractmethod
import requests

class BaseClient(ABC):
    @abstractmethod
    def make_get_request(self):
        pass

    @abstractmethod
    def __call__(self, *args, **kwds):
        pass

class ConcreteBaseClient():
    def __init__(self, base_url):
        self.base_url = base_url

    def make_get_request(self):
        res = requests.get(self.base_url)
        return res.json()
    
    def __call__(self, *args, **kwds):
        return self.make_get_request()

class WikiClient(ConcreteBaseClient):
    pass

class BookstoreClient(ConcreteBaseClient):
    pass

class Worker:
    def __init__(self,
                 wiki_client: WikiClient,
                 bookstore_client: BookstoreClient):
        self.wiki_client = wiki_client
        self.bookstore_client = bookstore_client

    def __call__(self, *args, **kwds):
        return {"wiki_data": self.wiki_client(),
                "bookstore_data": self.bookstore_client()}
    

# wiki_url = "https://ru.wikipedia.org/api/rest_v1/page/summary/Tesla_Cybertruck"
# bookstore_url = "https://gvev.ru/ulsu/android/apiengine?method=getCatalog"
# wiki_client = WikiClient(wiki_url)
# bookstore_client = BookstoreClient(bookstore_url)
# worker = Worker(wiki_client=wiki_client,bookstore_client=bookstore_client)
# res = worker()
# c=1