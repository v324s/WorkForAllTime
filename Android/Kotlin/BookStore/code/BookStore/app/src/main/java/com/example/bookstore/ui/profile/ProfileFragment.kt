package com.example.bookstore.ui.profile


import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProvider
import com.example.bookstore.databinding.FragmentProfileBinding
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import org.json.JSONObject
import java.net.URL
import java.text.SimpleDateFormat
import java.util.*
import javax.net.ssl.HttpsURLConnection

class ProfileFragment : Fragment() {
    private var _binding: FragmentProfileBinding? = null
    private val binding get() = _binding!!
    private lateinit var viewModel: ProfileViewModel

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentProfileBinding.inflate(inflater, container, false)
        viewModel = ViewModelProvider(this).get(ProfileViewModel::class.java)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        loadProfileData()
    }

    private fun loadProfileData() {
        CoroutineScope(Dispatchers.IO).launch {
            try {
                val url = URL("https://gvev.ru/ulsu/android/api/engine.php?method=getProfile")
                val connection = url.openConnection() as HttpsURLConnection
                connection.requestMethod = "GET"

                if (connection.responseCode == HttpsURLConnection.HTTP_OK) {
                    val response = connection.inputStream.bufferedReader().use { it.readText() }
                    val json = JSONObject(response)
                    val profile = json.getJSONArray("profile").getJSONObject(0)

                    withContext(Dispatchers.Main) {
                        displayProfileData(profile)
                    }
                }
            } catch (e: Exception) {
                e.printStackTrace()
            }
        }
    }

    private fun displayProfileData(profile: JSONObject) {
        // ФИО
        binding.tvFullName.text = "${profile.getString("last_name")} ${
            profile.getString("first_name")} ${
            profile.getString("middle_name")}"

        // Контактные данные
        binding.tvEmail.text = profile.getString("email")
        binding.tvPhone.text = profile.getString("tel")

        // Адрес
        binding.tvAddress.text = "${profile.getString("gorod")}, ${
            profile.getString("address")}"

        // Статистика
        binding.tvReviews.text = profile.getInt("reviews").toString()
        binding.tvOrders.text = profile.getInt("orders").toString()
        binding.tvTotalPrice.text = "${profile.getInt("totalPriceOrders")} ₽"

        // Дата регистрации
        val regTime = profile.getLong("regtime") * 1000
        val sdf = SimpleDateFormat("dd.MM.yyyy", Locale.getDefault())
        binding.tvRegDate.text = sdf.format(Date(regTime))
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
import com.example.bookstore.databinding.FragmentProfileBinding

class ProfileFragment : Fragment() {

    private var _binding: FragmentProfileBinding? = null

    // This property is only valid between onCreateView and
    // onDestroyView.
    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        val profileViewModel =
            ViewModelProvider(this).get(ProfileViewModel::class.java)

        _binding = FragmentProfileBinding.inflate(inflater, container, false)
        val root: View = binding.root

        val textView: TextView = binding.textNotifications
        profileViewModel.text.observe(viewLifecycleOwner) {
            textView.text = it
        }
        return root
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}*/