package com.example.bookstore.ui.catalog

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import androidx.navigation.fragment.findNavController
import androidx.navigation.fragment.navArgs
import com.bumptech.glide.Glide
import com.example.bookstore.R
import com.example.bookstore.databinding.FragmentBookDetailsBinding
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import org.json.JSONObject
import java.net.URL
import javax.net.ssl.HttpsURLConnection
import android.widget.Toast
import okhttp3.FormBody
import okhttp3.OkHttpClient
import okhttp3.Request

class BookDetailsFragment : Fragment() {
    private var _binding: FragmentBookDetailsBinding? = null
    private val binding get() = _binding!!
    private val args: BookDetailsFragmentArgs by navArgs()

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentBookDetailsBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        /*super.onViewCreated(view, savedInstanceState)
        loadBookDetails(args.bookId)*/
        super.onViewCreated(view, savedInstanceState)
        val bookId = args.bookId
        loadBookDetails(bookId)
        binding.buyButton.setOnClickListener {
            args.bookId?.let { bookId ->
                addToCart(bookId)
            }
        }

/*
        setSupportActionBar(binding.toolbar)
        supportActionBar?.setDisplayHomeAsUpEnabled(true)
        binding.toolbar.setNavigationOnClickListener {
            findNavController().navigateUp()
        }*/
    }

    private fun addToCart(bookId: Int) {
        binding.buyButton.isEnabled = false // Блокируем кнопку на время запроса
        CoroutineScope(Dispatchers.IO).launch {
            try {
                val client = OkHttpClient()
                val formBody = FormBody.Builder()
                    .add("method", "addToCart")
                    .add("book", bookId.toString())
                    .build()

                val request = Request.Builder()
                    .url("https://gvev.ru/ulsu/android/api/engine.php")
                    .post(formBody)
                    .build()

                val response = client.newCall(request).execute()
                val responseBody = response.body?.string()
                val json = JSONObject(responseBody ?: "")

                withContext(Dispatchers.Main) {
                    if (json.getBoolean("ok")) {
                        Toast.makeText(
                            context,
                            "Книга добавлена в корзину!",
                            Toast.LENGTH_SHORT
                        ).show()
                    } else {
                        Toast.makeText(
                            context,
                            "Не удалось добавить книгу в корзину",
                            Toast.LENGTH_SHORT
                        ).show()
                    }
                }
            } catch (e: Exception) {
                withContext(Dispatchers.Main) {
                    binding.buyButton.isEnabled = true
                    Toast.makeText(
                        context,
                        "Ошибка подключения: ${e.localizedMessage}",
                        Toast.LENGTH_SHORT
                    ).show()
                }
            } finally {
                withContext(Dispatchers.Main) {
                    binding.buyButton.isEnabled = true
                }
            }
        }
    }

    private fun loadBookDetails(bookId: Int) {
        CoroutineScope(Dispatchers.IO).launch {
            try {
                val url = URL("https://gvev.ru/ulsu/android/api/engine.php?method=getBook&id=$bookId")
                val connection = url.openConnection() as HttpsURLConnection
                connection.requestMethod = "GET"

                if (connection.responseCode == HttpsURLConnection.HTTP_OK) {
                    val response = connection.inputStream.bufferedReader().use { it.readText() }
                    val json = JSONObject(response)
                    val book = json.getJSONArray("book").getJSONObject(0)

                    withContext(Dispatchers.Main) {
                        displayBookDetails(book)
                    }
                }
            } catch (e: Exception) {
                e.printStackTrace()
            }
        }
    }

    private fun displayBookDetails(book: JSONObject) {
        Glide.with(this)
            .load("https://gvev.ru/diplom/${book.getString("img")}")
            .into(binding.bookImage)

        binding.bookTitle.text = book.getString("name")
        binding.bookAuthor.text = book.getString("author")
        binding.bookPublisher.text = book.getString("published")
        binding.bookSeries.text = book.getString("series")
        binding.bookYear.text = book.getString("year")
        binding.bookNumberOfPages.text = book.getString("numberOfPages")
        binding.bookFormat.text = book.getString("format")
        binding.bookTypeOfCover.text = book.getString("typeOfCover")
        binding.bookWeight.text = book.getString("weight")
        binding.bookAge.text = book.getString("age")
        binding.bookAnnotation.text = book.getString("annotation")
        binding.bookPrice.text = "${book.getInt("price")} ₽"
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}