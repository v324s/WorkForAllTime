package com.example.bookstore.ui.catalog

import android.graphics.Rect
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.bookstore.databinding.FragmentCatalogBinding
import android.widget.TextView
import androidx.navigation.fragment.findNavController
import androidx.recyclerview.widget.DividerItemDecoration
import com.example.bookstore.models.Book
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import org.json.JSONObject
import java.net.URL
import javax.net.ssl.HttpsURLConnection
import org.json.JSONArray

class ItemSpacingDecoration(private val spacing: Int) : RecyclerView.ItemDecoration() {
    override fun getItemOffsets(
        outRect: Rect,
        view: View,
        parent: RecyclerView,
        state: RecyclerView.State
    ) {
        outRect.bottom = spacing
    }
}

class CatalogFragment : Fragment() {

    private var _binding: FragmentCatalogBinding? = null
    private val binding get() = _binding!!
    private lateinit var messageTextView: TextView
    private lateinit var bookAdapter: BookAdapter
    private val books = mutableListOf<Book>()

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentCatalogBinding.inflate(inflater, container, false)
        messageTextView = binding.messageTextView // Добавьте TextView в ваш fragment_catalog.xml
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        setupRecyclerView()
        fetchMainMessage()
        fetchCatalog()
    }

    private fun fetchMainMessage() {
        CoroutineScope(Dispatchers.IO).launch {
            try {
                val url = URL("https://gvev.ru/ulsu/android/api/engine.php?method=getMainMessage")
                val connection = url.openConnection() as HttpsURLConnection
                connection.requestMethod = "GET"

                val responseCode = connection.responseCode
                if (responseCode == HttpsURLConnection.HTTP_OK) {
                    val response = connection.inputStream.bufferedReader().use { it.readText() }
                    val json = JSONObject(response)
                    val message = json.getString("message")

                    withContext(Dispatchers.Main) {
                        messageTextView.text = message
                    }
                }
            } catch (e: Exception) {
                e.printStackTrace()
                withContext(Dispatchers.Main) {
                    messageTextView.text = "Ошибка при загрузке сообщения"
                }
            }
        }
    }

    private fun setupRecyclerView() {
        bookAdapter = BookAdapter(books) { bookId ->
            // Обработка нажатия на кнопку "Подробнее"
            showBookDetails(bookId)
        }


        binding.booksRecyclerView.addItemDecoration(ItemSpacingDecoration(16))
        binding.booksRecyclerView.apply {
            layoutManager = LinearLayoutManager(context).also {
                it.orientation = LinearLayoutManager.VERTICAL
            }
            adapter = bookAdapter
            addItemDecoration(DividerItemDecoration(context, LinearLayoutManager.VERTICAL))
            /*
            layoutManager = LinearLayoutManager(context)
            adapter = bookAdapter
            */
        }
    }

    private fun fetchCatalog() {
        CoroutineScope(Dispatchers.IO).launch {
            try {
                val url = URL("https://gvev.ru/ulsu/android/api/engine.php?method=getCatalog")
                val connection = url.openConnection() as HttpsURLConnection
                connection.requestMethod = "GET"

                val responseCode = connection.responseCode
                if (responseCode == HttpsURLConnection.HTTP_OK) {
                    val response = connection.inputStream.bufferedReader().use { it.readText() }
                    val json = JSONObject(response)
                    val dataArray = json.getJSONArray("data")

                    books.clear()
                    for (i in 0 until dataArray.length()) {
                        val bookJson = dataArray.getJSONObject(i)
                        books.add(Book(
                            id = bookJson.getInt("id"),
                            name = bookJson.getString("name"),
                            author = bookJson.getString("author"),
                            price = bookJson.getInt("price"),
                            img = bookJson.getString("img")
                        ))
                    }

                    withContext(Dispatchers.Main) {
                        bookAdapter.notifyDataSetChanged()
                    }
                }
            } catch (e: Exception) {
                e.printStackTrace()
                withContext(Dispatchers.Main) {
                    // Показать сообщение об ошибке
                }
            }
        }
    }

    private fun showBookDetails(bookId: Int) {
        // Здесь будет переход на экран с деталями книги
        // Пока просто выведем ID в лог
        println("Selected book ID: $bookId")
        val action = CatalogFragmentDirections.actionCatalogToBookDetails(bookId)
        findNavController().navigate(action)
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}



/*
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProvider
import com.example.bookstore.databinding.FragmentCatalogBinding

class CatalogFragment : Fragment() {

    private var _binding: FragmentCatalogBinding? = null

    // This property is only valid between onCreateView and
    // onDestroyView.
    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        val catalogViewModel =
            ViewModelProvider(this).get(CatalogViewModel::class.java)

        _binding = FragmentCatalogBinding.inflate(inflater, container, false)
        val root: View = binding.root

        val textView: TextView = binding.textHome
        catalogViewModel.text.observe(viewLifecycleOwner) {
            textView.text = it
        }
        return root
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}*/