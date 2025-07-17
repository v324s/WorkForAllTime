using Photon.Pun;
using System;
using System.Collections;
using System.Collections.Generic;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Threading.Tasks;
using UnityEngine;
using static Unity.IO.LowLevel.Unsafe.AsyncReadManagerMetrics;

namespace UnityREPO
{
    public class Main : MonoBehaviour
    {
        private string[] tabs = { "Инфо", "Игрок", "Предметы", "ESP" };
        private int currentTab = 0;

        private ValuableObject hoveredObject = null; // Храним предмет, на который навели курсор
        private bool showItemNames = false;
        private bool showItemPrice = false;
        private bool showExtraction = false;
        private bool showEnemyName = false;
        private bool showEnemyHP = false;
        private bool showEnemyDistance = false;
        private bool energyDrink = false;
        private bool godMode = false;



        private static bool GUIMenu = true;



        GUIStyle style = new GUIStyle();


        private PlayerController[] PlayerObjects;
        private PlayerController localPlayer;
        private ExtractionPoint[] ExfilObjects;
        private ValuableObject[] valuableObjects;
        private Enemy[] EnemyObjects;

        public void Start()
        {
            
            style.fontSize = 16;
            style.fontStyle = FontStyle.Bold;
            style.normal.textColor = Color.red;

            Debug.Log("[nbsp] скрипт успешно запущен.");


            base.StartCoroutine(this.UpdateObjectsAndEntitiesPeriodically());
        }
        private IEnumerator UpdateObjectsAndEntitiesPeriodically()
        {
            for (; ; )
            {
                this.valuableObjects = FindObjectsOfType<ValuableObject>();
                this.ExfilObjects = FindObjectsOfType<ExtractionPoint>();
                this.PlayerObjects = FindObjectsOfType<PlayerController>();
                this.EnemyObjects = FindObjectsOfType<Enemy>();
                // this.debugEnergy = typeof(PlayerController).GetField("DebugEnergy", BindingFlags.Public | BindingFlags.Instance);
                this.CacheLocalPlayer();
                yield return new WaitForSeconds(10f);
            }
        }
        private void CacheLocalPlayer()
        {
            this.localPlayer = this.PlayerObjects.FirstOrDefault((PlayerController p) => p.cameraGameObjectLocal != null);
        }


        public void Update()
        {
            PlayerController playerController = FindAnyObjectByType<PlayerController>();
            if (Input.GetKeyDown(KeyCode.Delete))
            {
                Loader.unload();
            }
            if (Input.GetKeyDown(KeyCode.Home))
            {
                GUIMenu = !GUIMenu;
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
            if (hoveredObject != null && Input.GetKeyDown(KeyCode.F))
            {
                TeleportItemToPlayer(hoveredObject);
            }
            if (energyDrink)
            {
                if (playerController.EnergyCurrent <= 10f && energyDrink)
                {
                    playerController.EnergyCurrent = 40f;
                }
            }
        }


        public void OnGUI()
        {
            if (!GUIMenu) return;

            drawMenuWindow();

            hoveredObject = null;

            if (showItemNames || showItemPrice)
            {
                foreach (ValuableObject valuableObject in this.valuableObjects)
                {
                    Vector3 vector = this.WorldToScreen(valuableObject.transform.position);

                    if (IsOnScreen(vector))
                    {
                        var dollarValue = (float)typeof(ValuableObject)
                            .GetField("dollarValueCurrent", System.Reflection.BindingFlags.NonPublic | System.Reflection.BindingFlags.Instance)
                            .GetValue(valuableObject);

                        bool isHovered = IsCursorOverText(vector, valuableObject.name) || IsCursorOverText(vector, dollarValue.ToString() + "$");


                        if (showItemNames)
                        {
                            //this.DrawName(vector, valuableObject.name, Color.white);

                            this.DrawName(vector, valuableObject.name, isHovered ? Color.red : Color.white);
                        }
                        if (showItemPrice)
                        {
                            //this.DrawPrice(vector, valuableObject.dollarValueCurrent.ToString() + "$");

                            this.DrawPrice(vector, dollarValue.ToString() + "$", isHovered ? Color.red : Color.white);
                        }
                        if (isHovered)
                        {
                            hoveredObject = valuableObject;
                        }
                    }
                }
            }

            if (showExtraction)
            {
                foreach (ExtractionPoint extractionPoint in this.ExfilObjects)
                {
                    Vector3 vector2 = this.WorldToScreen(extractionPoint.transform.position);
                    Color color = extractionPoint.isLocked ? Color.red : Color.green;
                    if (IsOnScreen(vector2))
                    {
                        if (showExtraction)
                        {
                            this.DrawName(vector2, "ПВЗ", color);
                        }
                    }
                }
            }

            if (godMode)
            {
                foreach (PlayerController playerController in this.PlayerObjects)
                {
                    FieldInfo field = typeof(PlayerHealth).GetField("health", BindingFlags.Instance | BindingFlags.NonPublic);
                    int num2 = (int)field.GetValue(playerController.playerAvatarScript.playerHealth);
                    if (num2 <= 0)
                    {
                        return;
                    }
                    if (playerController.cameraGameObjectLocal != null)
                    {
                        if (godMode)
                        {
                            playerController.playerAvatarScript.playerHealth.InvincibleSet(999999f);
                        }
                    }
                }
            }
            else
            {
                foreach (PlayerController playerController in this.PlayerObjects)
                {
                    FieldInfo field = typeof(PlayerHealth).GetField("health", BindingFlags.Instance | BindingFlags.NonPublic);
                    int num2 = (int)field.GetValue(playerController.playerAvatarScript.playerHealth);
                    if (num2 > 100)
                    {
                        playerController.playerAvatarScript.playerHealth.InvincibleSet(100f);
                    }
                }
            }


            if (showEnemyName)
            {
                foreach (Enemy enemy in this.EnemyObjects)
                {
                    Vector3 vector3 = this.WorldToScreen(enemy.CenterTransform.position);
                    EnemyParent componentInParent = enemy.GetComponentInParent<EnemyParent>();
                    EnemyHealth componentInChildren = componentInParent.GetComponentInChildren<EnemyHealth>();
                    int health = componentInChildren.health;
                    FieldInfo fieldInfo = typeof(EnemyHealth).GetField("healthCurrent", BindingFlags.NonPublic | BindingFlags.Instance);
                    int currentHealth = (int)fieldInfo.GetValue(componentInChildren);

                    if (health <= 0)
                    {
                        return;
                    }
                    if (IsOnScreen(vector3))
                    {
                        if (showEnemyName)
                        {
                            if (this.localPlayer != null)
                            {
                                float num = Vector3.Distance(this.localPlayer.transform.position, enemy.CenterTransform.position);
                                string text = componentInParent.enemyName;
                                if (showEnemyDistance)
                                {
                                    text += string.Format(" [{0:F1}M]", num);
                                }
                                this.DrawName(vector3, text, Color.red);
                            }
                            else
                            {
                                this.DrawName(vector3, componentInParent.enemyName, Color.red);
                            }
                            if (showEnemyHP)
                            {
                                this.DrawHealth(vector3, "["+ currentHealth.ToString() +"/"+ health.ToString() + "HP]", Color.red);
                            }
                        }
                    }
                }
            }


        }
        private bool IsCursorOverText(Vector3 screenPos, string text)
        {
            Vector2 textSize = new GUIStyle() { fontSize = 12 }.CalcSize(new GUIContent(text));
            Rect textRect = new Rect(screenPos.x - textSize.x / 2, screenPos.y - textSize.y, textSize.x, textSize.y);
            return textRect.Contains(Event.current.mousePosition);
        }
        private void TeleportItemToPlayer(ValuableObject item)
        {
                Transform cameraTransform = Camera.main.transform; // Берём камеру вместо игрока

                if (cameraTransform != null)
                {
                    Vector3 newPosition = cameraTransform.position + cameraTransform.forward * 2f; // Перед камерой
                    item.transform.position = newPosition;
                }
        }
        public void DrawName(Vector3 screenPos, string name, Color color)
        {
            GUIStyle guistyle = new GUIStyle();
            guistyle.normal.textColor = color;
            guistyle.fontSize = 12;
            guistyle.alignment = TextAnchor.MiddleCenter;
            Vector2 vector = guistyle.CalcSize(new GUIContent(name));
            Vector2 vector2 = new Vector2(screenPos.x - vector.x / 2f, screenPos.y - vector.y - 1f);
            GUI.Label(new Rect(vector2.x, vector2.y, vector.x, vector.y), name.Replace("Valuable ", "").Replace("(Clone)", "").Trim(), guistyle);
        }
        public void DrawPrice(Vector3 screenPos, string price, Color color)
        {
            GUIStyle guistyle = new GUIStyle();
            guistyle.normal.textColor = color;
            guistyle.fontSize = 12;
            guistyle.alignment = TextAnchor.MiddleCenter;
            Vector2 vector = guistyle.CalcSize(new GUIContent(price));
            Vector2 vector2 = new Vector2(screenPos.x - vector.x / 2f, screenPos.y + 1f);
            GUI.Label(new Rect(vector2.x, vector2.y, vector.x, vector.y), price, guistyle);
        }
        public void DrawHealth(Vector3 screenPos, string health, Color color)
        {
            GUIStyle guistyle = new GUIStyle();
            guistyle.normal.textColor = color;
            guistyle.fontSize = 12;
            guistyle.alignment = TextAnchor.MiddleCenter;
            Vector2 vector = guistyle.CalcSize(new GUIContent(health));
            Vector2 vector2 = new Vector2(screenPos.x - vector.x / 2f, screenPos.y + 1f);
            GUI.Label(new Rect(vector2.x, vector2.y, vector.x, vector.y), health, guistyle);
        }
        public static bool IsOnScreen(Vector3 position)
        {
            return position.x > 0f && position.x < (float)Screen.width && position.y > 0f && position.y < (float)Screen.height && position.z > 0f;
        }
        
        private void drawMenuWindow()
        {
            if (!GUIMenu) return;

            GUI.Box(new Rect(10, 10, 400, 300), "Меню");

            GUILayout.BeginArea(new Rect(20, 40, 380, 40));
            GUILayout.BeginHorizontal();

            for (int i = 0; i < tabs.Length; i++)
            {
                if (GUILayout.Button(tabs[i], GUILayout.Width(90)))
                {
                    currentTab = i;
                }
            }

            GUILayout.EndHorizontal();
            GUILayout.EndArea();

            GUILayout.BeginArea(new Rect(20, 90, 380, 380));

            switch (currentTab)
            {
                case 0:
                    GUILayout.Label("Информация:");
                    GUILayout.Space(10);
                    GUILayout.Label("Page up - Показать курсор");
                    GUILayout.Label("Page down - Спрятать курсор");
                    GUILayout.Label("Home - Скрыть/показать меню");
                    GUILayout.Label("Delete - Закрывает меню");
                    break;
                case 1:
                    GUILayout.Label("Игрок:");
                    godMode = GUILayout.Toggle(godMode, "GodMode");
                    energyDrink = GUILayout.Toggle(energyDrink, "EnergyDrink");
                    break;
                case 2:
                    GUILayout.Label("Предметы:");
                    GUILayout.Label("Магнит: Курсором наведите на имя предмета, загорится красным - нажмите F");

                    break;
                case 3:
                    GUILayout.Label("ESP:", new GUIStyle(GUI.skin.label)
                    {
                        alignment = TextAnchor.MiddleCenter,
                        fontSize = 14
                    }, GUILayout.ExpandWidth(true));
                    GUILayout.Space(10);
                    GUILayout.Label("Предметы:");
                    showItemNames = GUILayout.Toggle(showItemNames, "Название");
                    showItemPrice = GUILayout.Toggle(showItemPrice, "Цена");
                    GUILayout.Space(10);
                    GUILayout.Label("Экстракторы:");
                    showExtraction = GUILayout.Toggle(showExtraction, "ПВЗ");
                    GUILayout.Space(10);
                    GUILayout.Label("Мобы:");
                    showEnemyName = GUILayout.Toggle(showEnemyName, "Имя");
                    showEnemyHP = GUILayout.Toggle(showEnemyHP, "HP");
                    showEnemyDistance = GUILayout.Toggle(showEnemyDistance, "Дистанция");
                    break;
            }

            GUILayout.EndArea();
        }
        public Vector3 WorldToScreen(Vector3 worldPosition)
        {
            Matrix4x4 lhs = Camera.main.projectionMatrix * Camera.main.worldToCameraMatrix;
            Vector4 vector = lhs * new Vector4(worldPosition.x, worldPosition.y, worldPosition.z, 1f);
            bool flag = vector.w <= 0f;
            Vector3 result;
            if (flag)
            {
                result = new Vector3(-1f, -1f, -1f);
            }
            else
            {
                Vector3 vector2 = new Vector3(vector.x / vector.w, vector.y / vector.w, vector.z / vector.w);
                Vector3 vector3 = new Vector3((vector2.x + 1f) * 0.5f * (float)Screen.width, (1f - vector2.y) * 0.5f * (float)Screen.height, vector2.z);
                result = vector3;
            }
            return result;
        }
    }
}
