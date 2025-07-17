package com.example.bookstore.ui.cart

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import android.widget.Toast
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProvider
import androidx.navigation.fragment.findNavController
import com.example.bookstore.databinding.FragmentCartBinding
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.bookstore.models.Book
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import org.json.JSONObject
import java.net.URL
import javax.net.ssl.HttpsURLConnection
import okhttp3.FormBody
import okhttp3.OkHttpClient
import okhttp3.Request

class CartFragment : Fragment() {
    private var _binding: FragmentCartBinding? = null
    private val binding get() = _binding!!
    private lateinit var viewModel: CartViewModel
    private lateinit var cartAdapter: CartAdapter


    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentCartBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        viewModel = ViewModelProvider(this).get(CartViewModel::class.java)

        setupRecyclerView()
        loadCartData()
    }

    private fun setupRecyclerView() {
        cartAdapter = CartAdapter(
            initialBooks = emptyList(),
            onDetailsClick = { bookId ->
                val action = CartFragmentDirections.actionNavigationCartToNavigationBookDetails(bookId)
                findNavController().navigate(action)
            },
            onRemoveClick = { bookId, callback ->
                removeFromCart(bookId, callback)
            }
        )

        binding.cartRecyclerView.apply {
            layoutManager = LinearLayoutManager(context)
            adapter = cartAdapter
        }
    }



    private fun loadCartData() {
        binding.progressBar.visibility = View.VISIBLE
        binding.emptyCartText.visibility = View.GONE

        CoroutineScope(Dispatchers.IO).launch {
            try {
                val url = URL("https://gvev.ru/ulsu/android/api/engine.php?method=getCart")
                val connection = url.openConnection() as HttpsURLConnection
                connection.requestMethod = "GET"

                if (connection.responseCode == HttpsURLConnection.HTTP_OK) {
                    val response = connection.inputStream.bufferedReader().use { it.readText() }
                    val json = JSONObject(response)
                    val cartArray = json.getJSONArray("cart")

                    val books = mutableListOf<Book>()
                    for (i in 0 until cartArray.length()) {
                        val bookJson = cartArray.getJSONObject(i)
                        books.add(Book(
                            id = bookJson.getInt("id"),
                            name = bookJson.getString("name"),
                            author = bookJson.getString("author"),
                            price = bookJson.getInt("price"),
                            img = bookJson.getString("img")
                        ))
                    }

                    withContext(Dispatchers.Main) {
                        cartAdapter.updateBooks(books)
                        if (books.isEmpty()) {
                            binding.emptyCartText.visibility = View.VISIBLE
                        }
                        binding.progressBar.visibility = View.GONE
                    }
                }
            } catch (e: Exception) {
                withContext(Dispatchers.Main) {
                    binding.progressBar.visibility = View.GONE
                    binding.emptyCartText.visibility = View.VISIBLE
                    binding.emptyCartText.text = "Ошибка загрузки корзины"
                }
            }
        }
    }


    private fun removeFromCart(bookId: Int, callback: (Boolean) -> Unit) {
        CoroutineScope(Dispatchers.IO).launch {
            try {
                val client = OkHttpClient()
                val formBody = FormBody.Builder()
                    .add("method", "removeFromCart")
                    .add("book", bookId.toString())  // Теперь передаем именно ID книги
                    .build()

                val request = Request.Builder()
                    .url("https://gvev.ru/ulsu/android/api/engine.php")
                    .post(formBody)
                    .build()

                val response = client.newCall(request).execute()
                val responseBody = response.body?.string()
                val json = JSONObject(responseBody ?: "")
                val success = json.getBoolean("ok")

                withContext(Dispatchers.Main) {
                    if (success) {
                        val removed = cartAdapter.removeBookById(bookId)  // Удаляем по ID
                        if (removed) {
                            if (cartAdapter.itemCount == 0) {
                                binding.emptyCartText.visibility = View.VISIBLE
                            }
                            Toast.makeText(context, "Книга удалена!", Toast.LENGTH_SHORT).show()
                        }
                    }
                    callback(success)
                }
            } catch (e: Exception) {
                withContext(Dispatchers.Main) {
                    Toast.makeText(context, "Ошибка сети", Toast.LENGTH_SHORT).show()
                    callback(false)
                }
            }
        }
    }

    private suspend fun makeRemoveRequest(bookId: Int): Boolean {
        // Реализация запроса к серверу
        val client = OkHttpClient()
        val formBody = FormBody.Builder()
            .add("method", "removeFromCart")
            .add("book", bookId.toString())
            .build()

        val request = Request.Builder()
            .url("https://gvev.ru/ulsu/android/api/engine.php")
            .post(formBody)
            .build()

        val response = client.newCall(request).execute()
        val responseBody = response.body?.string()
        val json = JSONObject(responseBody ?: "")
        return json.getBoolean("ok")
    }

    /*
    private fun removeFromCart(bookId: Int) {
        // Здесь будет запрос на удаление книги из корзины
        // Пока просто обновим список
        val updatedList = cartAdapter.books.filter { it.id != bookId }.toList()
        cartAdapter = CartAdapter(updatedList,
            onDetailsClick = { id ->
                val action = CartFragmentDirections.actionNavigationCartToNavigationBookDetails(id)
                findNavController().navigate(action)
            },
            onRemoveClick = { id ->
                removeFromCart(id)
            }
        )
        binding.cartRecyclerView.adapter = cartAdapter

        if (updatedList.isEmpty()) {
            binding.emptyCartText.visibility = View.VISIBLE
        }
    }*/

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}