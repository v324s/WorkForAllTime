using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using UnityEngine;

namespace UnityREPO
{
    public class Loader
    {
        public static void Init()
        {
            Loader.Load = new GameObject();
            Loader.Load.AddComponent<Main>();
            UnityEngine.Object.DontDestroyOnLoad(Loader.Load);
        }

        private static GameObject Load;

        public static void unload()
        {
            UnityEngine.Object.Destroy(Loader.Load);
        }
    }
}
