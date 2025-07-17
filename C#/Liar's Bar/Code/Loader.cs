using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Remoting.Messaging;
using System.Text;
using System.Threading.Tasks;
using UnityEngine;

namespace lie
{
    internal class Loader
    {
        private static GameObject Load;

        public static void Init()
        {
            Loader.Load = new GameObject();
            Loader.Load.AddComponent<lie>();
            UnityEngine.Object.DontDestroyOnLoad(Loader.Load);
        }


        public static void unload()
        {
            UnityEngine.Object.Destroy(Loader.Load);
        }
    }
}
