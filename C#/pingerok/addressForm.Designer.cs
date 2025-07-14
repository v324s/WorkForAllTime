namespace pingerok
{
    partial class AddressForm
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            listBoxAddresses = new ListBox();
            buttonAdd = new Button();
            buttonDelete = new Button();
            SuspendLayout();
            // 
            // listBoxAddresses
            // 
            listBoxAddresses.FormattingEnabled = true;
            listBoxAddresses.Location = new Point(12, 12);
            listBoxAddresses.Name = "listBoxAddresses";
            listBoxAddresses.Size = new Size(235, 224);
            listBoxAddresses.TabIndex = 0;
            // 
            // buttonAdd
            // 
            buttonAdd.Location = new Point(271, 12);
            buttonAdd.Name = "buttonAdd";
            buttonAdd.Size = new Size(94, 29);
            buttonAdd.TabIndex = 1;
            buttonAdd.Text = "Добавить";
            buttonAdd.UseVisualStyleBackColor = true;
            buttonAdd.Click += buttonAdd_Click;
            // 
            // buttonDelete
            // 
            buttonDelete.Location = new Point(271, 207);
            buttonDelete.Name = "buttonDelete";
            buttonDelete.Size = new Size(94, 29);
            buttonDelete.TabIndex = 2;
            buttonDelete.Text = "Удалить";
            buttonDelete.UseVisualStyleBackColor = true;
            buttonDelete.Click += buttonDelete_Click;
            // 
            // AddressForm
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(376, 251);
            Controls.Add(buttonDelete);
            Controls.Add(buttonAdd);
            Controls.Add(listBoxAddresses);
            FormBorderStyle = FormBorderStyle.FixedDialog;
            MaximizeBox = false;
            Name = "AddressForm";
            StartPosition = FormStartPosition.CenterParent;
            Text = "IP Адреса";
            Load += AddressForm_Load;
            ResumeLayout(false);
        }

        #endregion

        private ListBox listBoxAddresses;
        private Button buttonAdd;
        private Button buttonDelete;
    }
}