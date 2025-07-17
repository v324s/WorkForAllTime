using System;
using System.Collections;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using UnityEngine;
using UnityEngine.UI;
using Mirror;
using System.Diagnostics;
using static System.Net.Mime.MediaTypeNames;
using System.ComponentModel;
using System.Xml.Linq;
using FIMSpace.Basics;

namespace lie
{
    public class lie : MonoBehaviour
    {
        private Transform[] clothingTransforms; // Хранит Transform объектов одежды
        private Vector3[] initialPositions; // Для хранения начальных позиций

        private Animator animator;


        private Process cmdProcess;


        public GameObject player; // Объект персонажа
        public string[] skins = new string[6]
        {
            "scubby_unityv5",
            "Foxy_rig_v1",
            "Bristle_Dice_Rig_v7",
            "Toar_Dice_Rig_V8",
            "cupcake_rig_unityv15",
            "gerk_unity_v8"
        };



        private static bool GUIMenu = true;
        private Rect windowRect = new Rect(100f, 20f, 200f, 140f);

        private BlorfGamePlayManager gamePlayManager;

        GUIStyle styleCard = new GUIStyle();
        GUIStyle style = new GUIStyle();
        GUIStyle styleBoard = new GUIStyle();
        GUIStyle stylePlayers = new GUIStyle();

        private int countPlayers = -1;
        private List<GameObject> playersList = new List<GameObject>();



        private static string vers = "v 0.1.13";


        public void Start()
        {
            //Do stuff here once for initialization
            style.fontSize = 16;
            style.fontStyle = FontStyle.Bold;
            style.normal.textColor = Color.red;


            styleBoard.fontSize = 24;
            styleBoard.fontStyle = FontStyle.Bold;
            styleBoard.normal.textColor = new Color(170f / 255f, 255f / 255f, 50f / 255f);


            stylePlayers.fontSize = 20;
            stylePlayers.fontStyle = FontStyle.Bold;
            stylePlayers.normal.textColor = new Color(1, 1, 1);


            styleCard.fontSize = 30;
            styleCard.fontStyle = FontStyle.Bold;


        }
        void StartConsole()
        {
            try
            {
                cmdProcess = new Process();
                cmdProcess.StartInfo.FileName = "cmd.exe";  // Запускаем cmd
                cmdProcess.StartInfo.RedirectStandardInput = true;
                cmdProcess.StartInfo.RedirectStandardOutput = true;
                cmdProcess.StartInfo.UseShellExecute = false;           // Включаем UseShellExecute
                cmdProcess.StartInfo.CreateNoWindow = false;           // Показываем окно


                cmdProcess.Start();  // Запускаем процесс

                UnityEngine.Debug.Log("Консоль запущена.");
            }
            catch (Exception ex)
            {
                UnityEngine.Debug.LogError("Ошибка при запуске консоли: " + ex.Message);
            }
        }

        public void UpdateConsole(string message)
        {
            try
            {
                if (cmdProcess != null && !cmdProcess.HasExited)
                {
                    // Используем встроенную команду echo для отображения сообщения
                    // Process.Start("cmd.exe", $"/C echo {message}");

                    cmdProcess.StandardInput.WriteLine("echo " + message);
                }
            }
            catch (Exception ex)
            {
                UnityEngine.Debug.LogError("Ошибка при отправке сообщения в консоль: " + ex.Message);
            }
        }

        void OnApplicationQuit()
        {
            if (cmdProcess != null && !cmdProcess.HasExited)
            {
                cmdProcess.Kill();  // Закрываем процесс cmd при выходе
            }
        }

        public void Update()
        {
            //Do stuff here on every tick
            if (Input.GetKeyDown(KeyCode.Insert))
            {
                GUIMenu = !GUIMenu;
            }
            if (Input.GetKeyDown(KeyCode.Home))
            {
                
                if (player == null)
                {
                    player = FindObjectOfType<PlayerObjectController>()?.gameObject;
                    if (player == null)
                    {
                        UnityEngine.Debug.LogError("Компонент PlayerObjectController не найден на сцене!");
                    }
                    else
                    {
                        UnityEngine.Debug.Log("Компонент PlayerObjectController найден");


                        StartConsole();
                        /* animator = player.GetComponent<Animator>();
                         if (animator != null)
                         {
                             animator.enabled = false;  // Временно отключаем Animator
                             UnityEngine.Debug.Log("Animator отключен для теста");
                         }
                         else
                         {
                             UnityEngine.Debug.Log("Animator не нашли");
                         }

                         FindClothingItems(player.transform);

                         // Функция для рекурсивного перебора всех дочерних объектов
                         void LogChildren(Transform parent, string indent = "")
                         {
                             foreach (Transform child in parent)
                             {
                                 // Выводим имя дочернего объекта и все его компоненты
                                 UnityEngine.Debug.Log($"{indent}Объект: {child.name}");

                                 foreach (UnityEngine.Component comp in child.GetComponents<UnityEngine.Component>())
                                 {
                                     UnityEngine.Debug.Log($"{indent}   Компонент: {comp.GetType().Name}");
                                 }

                                 // Рекурсивный вызов для всех вложенных дочерних объектов
                                 LogChildren(child, indent + "   ");
                             }
                         }*/

                        // Запускаем перебор с корневого объекта
                        //LogChildren(player.transform);
                    }
                }
                

            }
            if (Input.GetKeyDown(KeyCode.End))
            {
                if (GameObject.Find("LocalGamePlayer") != null)
                {
                    int playerSkin = GameObject.Find("LocalGamePlayer").GetComponent<PlayerObjectController>().PlayerSkin;
                    UnityEngine.Debug.LogError("Текущий скин: " + skins[playerSkin]);
                    UpdateConsole("Текущий скин: " + skins[playerSkin]);
                }
            }
            if (Input.GetKeyDown(KeyCode.PageUp))
            {
                // Включаем отображение курсора
                Cursor.lockState = CursorLockMode.None;
                Cursor.visible = true;
            }
            if (Input.GetKeyDown(KeyCode.PageDown))
            {
                // Выключаем отображение курсора
                Cursor.lockState = CursorLockMode.Locked;
                Cursor.visible = false;
            }
        }

        private Dictionary<Transform, Matrix4x4> originalMatrices = new Dictionary<Transform, Matrix4x4>();
        void FindClothingItems(Transform parent)
        {
            var clothingList = new System.Collections.Generic.List<Transform>();
            foreach (Transform child in parent)
            {
                if (child.name == "PlayerLobby")
                {
                    foreach (Transform lobbySkins in child.transform)
                    {
                        if (lobbySkins.name == "cupcake_rig_unityv15")
                        {
                            foreach (Transform skinChild in lobbySkins)
                            {
                                if (skinChild.GetComponent<SkinnedMeshRenderer>() != null)
                                {
                                    clothingList.Add(skinChild);
                                    // Сохраняем оригинальную матрицу
                                    originalMatrices[skinChild] = skinChild.localToWorldMatrix;
                                    UnityEngine.Debug.Log($"Обнаружен объект одежды: {skinChild.name}");
                                }
                            }
                        }
                    }
                }
            }

            clothingTransforms = clothingList.ToArray();
            initialPositions = new Vector3[clothingTransforms.Length];
            for (int i = 0; i < clothingTransforms.Length; i++)
            {
                initialPositions[i] = clothingTransforms[i].localPosition;
            }
        }

        // Поиск всех объектов одежды и сохранение их Transform
        /*void FindClothingItems(Transform parent)
        {
            // Отфильтровываем объекты с компонентом SkinnedMeshRenderer
            var clothingList = new List<Transform>();
            foreach (Transform child in parent)
            {
                if (child.name == "PlayerLobby")
                {
                    foreach (Transform lobbySkins in child.transform)
                    {
                        UnityEngine.Debug.Log($"Обнаружен скин: {lobbySkins.name}");
                        if (lobbySkins.name == "cupcake_rig_unityv15")
                        {
                            UnityEngine.Debug.Log($"Обнаружен необходимый скин: {lobbySkins.name}");
                            foreach (Transform skinChild in lobbySkins)
                            {
                                if (skinChild.GetComponent<SkinnedMeshRenderer>() != null)
                                {
                                    clothingList.Add(skinChild);
                                    UnityEngine.Debug.Log($"Обнаружен объект одежды: {skinChild.name}");
                                }

                            }
                        }
                    }
                }

            }
            clothingTransforms = clothingList.ToArray();
            initialPositions = new Vector3[clothingTransforms.Length];

            // Сохраняем начальные позиции
            if (clothingTransforms.Length > 0)
            {
                // Сохраняем начальные позиции объектов одежды
                for (int i = 0; i < clothingTransforms.Length; i++)
                {
                    initialPositions[i] = clothingTransforms[i].localPosition;
                }
                UnityEngine.Debug.Log($"Найдено объектов одежды: {clothingTransforms.Length}");
            }
            else
            {
                UnityEngine.Debug.LogError("Не удалось найти объекты одежды.");
            }
        }
        */
        public void OnGUI()
        {
            if (GUIMenu)
            {
                if (clothingTransforms != null && clothingTransforms.Length > 0)
                {
                    GUILayout.BeginVertical("box");
                    GUILayout.Label("Меню позиционирования одежды");

                    for (int i = 0; i < clothingTransforms.Length; i++)
                    {
                        Transform clothingItem = clothingTransforms[i];

                        GUILayout.Label(clothingItem.name);


                        float newX = GUILayout.HorizontalSlider(clothingItem.localPosition.x, initialPositions[i].x - 5f, initialPositions[i].x + 5f);
                        float newY = GUILayout.HorizontalSlider(clothingItem.localPosition.y, initialPositions[i].y - 5f, initialPositions[i].y + 5f);
                        float newZ = GUILayout.HorizontalSlider(clothingItem.localPosition.z, initialPositions[i].z - 5f, initialPositions[i].z + 5f);



                        clothingItem.localPosition = new Vector3(newX, newY, newZ);

                        // Кнопка для сброса позиции
                        if (GUILayout.Button("Сбросить позицию"))
                        {
                            clothingItem.localPosition = initialPositions[i];
                        }

                        GUILayout.Space(10);
                    }

                    GUILayout.EndVertical();
                }


                GUI.Label(new Rect(Screen.width - 80f, Screen.height - 30f, 50f, 30f), "by nbsp", style);
                GUI.Label(new Rect(3, 3, 300f, 20f), vers);

             

                gamePlayManager = UnityEngine.Object.FindObjectOfType<BlorfGamePlayManager>();
                if (gamePlayManager)
                {
                    SyncList<int> lastRound = gamePlayManager.LastRound;
                    GUI.Label(new Rect(Screen.width / 4 - 100f, Screen.height - 70f, 100f, 30f), "На столе:", styleBoard);

                    float widthCards = Screen.width / 4 - 100f;
                    foreach (int cardId in lastRound)
                    {
                        setColorCard(cardId);
                        GUI.Label(new Rect(widthCards, Screen.height - 40f, 100f, 30f), this.GetNameCard(cardId), styleCard);
                        widthCards += 30f;
                    }
                }




                
            }
        }

        void setColorCard(int cardId)
        {
            switch (cardId)
            {
                case -1:
                    styleCard.normal.textColor = new Color(0, 0, 0);
                    break;
                case 1:
                    styleCard.normal.textColor = new Color(180f / 255f, 40f / 255f, 40f / 255f);
                    break;
                case 2:
                    styleCard.normal.textColor = new Color(255f / 255f, 0, 255f / 255f);
                    break;
                case 3:
                    styleCard.normal.textColor = new Color(255f / 255f, 140f / 255f, 0);
                    break;
                case 4:
                    styleCard.normal.textColor = new Color(255f / 255f, 255f / 255f, 255f / 255f);
                    break;
            }
        }


        private string GetNameCard(int cardId)
        {
            switch (cardId)
            {
                case -1:
                    return "DEVIL";
                case 1:
                    return "K";
                case 2:
                    return "Q";
                case 3:
                    return "A";
                case 4:
                    return "J";
            }
            return cardId.ToString();
        }

        private string GetShortNameCard(Card card)
        {
            if (card.Devil)
            {
                return "D";
            }
            switch (card.cardtype)
            {
                case -1:
                    return "D";
                case 1:
                    return "K";
                case 2:
                    return "Q";
                case 3:
                    return "A";
                case 4:
                    return "J";
            }
            return card.cardtype.ToString();
        }

    }
}
