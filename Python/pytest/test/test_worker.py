from worker import WikiClient, BookstoreClient, Worker

def test_worker(monkeypatch):
    execute_cnt = 0
    execute_urls = set()
    def mock_make_get_request(*args, **kwds):
        nonlocal execute_cnt
        nonlocal execute_urls
        execute_cnt += 1
        execute_urls.add(args[0].base_url)

    monkeypatch.setattr("worker.ConcreteBaseClient.make_get_request", mock_make_get_request)

    wiki_url = "https://test_url_wiki/"
    bookstore_url = "http://test_url_bookstore"

    wiki_client = WikiClient(wiki_url)
    bookstore_client = BookstoreClient(bookstore_url)

    worker = Worker(wiki_client = wiki_client, bookstore_client = bookstore_client)
    res = worker()
    assert execute_cnt == 2
    assert {wiki_url, bookstore_url} == execute_urls