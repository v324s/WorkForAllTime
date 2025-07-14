namespace pingerok
{
    partial class AddIpForm
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
            buttonOk = new Button();
            textBoxIp = new TextBox();
            SuspendLayout();
            // 
            // buttonOk
            // 
            buttonOk.Location = new Point(60, 78);
            buttonOk.Name = "buttonOk";
            buttonOk.Size = new Size(125, 29);
            buttonOk.TabIndex = 0;
            buttonOk.Text = "OK";
            buttonOk.UseVisualStyleBackColor = true;
            buttonOk.Click += buttonOk_Click;
            // 
            // textBoxIp
            // 
            textBoxIp.Location = new Point(60, 33);
            textBoxIp.Name = "textBoxIp";
            textBoxIp.PlaceholderText = "192.168.1.1";
            textBoxIp.Size = new Size(125, 27);
            textBoxIp.TabIndex = 1;
            textBoxIp.TextAlign = HorizontalAlignment.Center;
            // 
            // AddIpForm
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(249, 119);
            Controls.Add(textBoxIp);
            Controls.Add(buttonOk);
            FormBorderStyle = FormBorderStyle.FixedDialog;
            MaximizeBox = false;
            Name = "AddIpForm";
            StartPosition = FormStartPosition.CenterParent;
            Text = "New IP";
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Button buttonOk;
        private TextBox textBoxIp;
    }
}