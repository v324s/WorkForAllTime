using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Drawing.Text;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace pingerok
{
    public partial class AddressForm : Form
    {
        public AddressForm()
        {
            InitializeComponent();
        }

        private void buttonAdd_Click(object sender, EventArgs e)
        {
            using (AddIpForm addIpForm = new AddIpForm())
            {
                if (addIpForm.ShowDialog() == DialogResult.OK)
                {
                    string ipAddress = addIpForm.IpAddress;

                    if (!string.IsNullOrWhiteSpace(ipAddress))
                    {
                        listBoxAddresses.Items.Add(ipAddress);
                        AddIpButtonToMainForm(ipAddress);
                    }
                }
            }
        }

        private void AddIpButtonToMainForm(string ipAddress)
        {
            if (this.Owner is MainForm form1)
            {
                form1.AddIpButton(ipAddress, new Point(10, 10));
            }
        }

        private void buttonDelete_Click(object sender, EventArgs e)
        {
            if (listBoxAddresses.SelectedItem != null)
            {
                string ipAddress = listBoxAddresses.SelectedItem.ToString();
                listBoxAddresses.Items.Remove(ipAddress); // Удаляем из списка

                if (this.Owner is MainForm mainForm)
                {
                    mainForm.RemoveIpButton(ipAddress); // Удаляем кнопку с панели
                }
            }
        }

        private void AddressForm_Load(object sender, EventArgs e)
        {
            if (this.Owner is MainForm mainForm)
            {
                foreach (var item in mainForm.ipAddressList)
                {
                    listBoxAddresses.Items.Add(item.IpAddress);
                }
            }
            
        }
    }
}
