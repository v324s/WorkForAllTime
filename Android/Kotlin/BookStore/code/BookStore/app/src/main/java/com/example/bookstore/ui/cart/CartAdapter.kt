package com.example.bookstore.ui.cart

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.example.bookstore.R
import com.example.bookstore.models.Book

class CartAdapter(
    private val initialBooks: List<Book>,
    private val onDetailsClick: (Int) -> Unit,
    private val onRemoveClick: (Int, (Boolean) -> Unit) -> Unit // Теперь с callback
) : RecyclerView.Adapter<CartAdapter.CartViewHolder>() {

    private var books: MutableList<Book> = initialBooks.toMutableList()

    fun removeBookById(bookId: Int): Boolean {
        val iterator = books.iterator()
        while (iterator.hasNext()) {
            val book = iterator.next()
            if (book.id == bookId) {  // Сравниваем по ID книги
                iterator.remove()
                notifyDataSetChanged()
                return true
            }
        }
        return false
    }

    fun getBooks(): List<Book> = books.toList()

    fun updateBooks(newBooks: List<Book>) {
        books.clear()
        books.addAll(newBooks)
        notifyDataSetChanged()
    }

    inner class CartViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        private val imageView: ImageView = itemView.findViewById(R.id.bookImage)
        private val titleView: TextView = itemView.findViewById(R.id.bookTitle)
        private val authorView: TextView = itemView.findViewById(R.id.bookAuthor)
        private val priceView: TextView = itemView.findViewById(R.id.bookPrice)
        private val detailsButton: Button = itemView.findViewById(R.id.detailsButton)
        private val removeButton: Button = itemView.findViewById(R.id.removeButton)

        fun bind(book: Book) {
            Glide.with(itemView.context)
                .load("https://gvev.ru/diplom/${book.img}")
                .placeholder(R.drawable.ic_book_placeholder)
                .into(imageView)

            titleView.text = book.name
            authorView.text = book.author
            priceView.text = "${book.price} ₽"

            detailsButton.setOnClickListener { onDetailsClick(book.id) }
            //removeButton.setOnClickListener { onRemoveClick(book.id) }
            removeButton.setOnClickListener {
                removeButton.isEnabled = false
                removeButton.text = "Удаление..."
                onRemoveClick(book.id) { success ->
                    removeButton.post {
                        removeButton.isEnabled = true
                        removeButton.text = "Удалить"
                        if (!success) {
                            // Можно показать ошибку на конкретном элементе
                        }
                    }
                }
            }
        }

    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): CartViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_cart, parent, false)
        return CartViewHolder(view)
    }

    override fun onBindViewHolder(holder: CartViewHolder, position: Int) {
        holder.bind(books[position])
    }


    override fun getItemCount(): Int = books.size
}