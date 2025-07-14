using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace pingerok
{
    public partial class AddIpForm : Form
    {
        public string IpAddress { get; private set; } = string.Empty;
        public AddIpForm()
        {
            InitializeComponent();
        }

        private void buttonOk_Click(object sender, EventArgs e)
        {
            IpAddress = textBoxIp.Text;
            this.DialogResult = DialogResult.OK;
            this.Close();
        }
    }
}
