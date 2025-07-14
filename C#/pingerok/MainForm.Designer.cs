namespace pingerok
{
    partial class MainForm
    {
        /// <summary>
        ///  Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        ///  Clean up any resources being used.
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
        ///  Required method for Designer support - do not modify
        ///  the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            toolStripMenuItem1 = new MenuStrip();
            программаToolStripMenuItem = new ToolStripMenuItem();
            toolStripMenuItemPositioningMode = new ToolStripMenuItem();
            fullsizeToolStripMenuItem = new ToolStripMenuItem();
            темнаяТемаToolStripMenuItem = new ToolStripMenuItem();
            exitToolStripMenuItem = new ToolStripMenuItem();
            файлToolStripMenuItem = new ToolStripMenuItem();
            открытьToolStripMenuItem = new ToolStripMenuItem();
            сохранитьToolStripMenuItem = new ToolStripMenuItem();
            сохранитьКакToolStripMenuItem = new ToolStripMenuItem();
            адресаToolStripMenuItem = new ToolStripMenuItem();
            добавитьМеткуToolStripMenuItem = new ToolStripMenuItem();
            panel1 = new Panel();
            toolStripMenuItem1.SuspendLayout();
            SuspendLayout();
            // 
            // toolStripMenuItem1
            // 
            toolStripMenuItem1.BackColor = SystemColors.Control;
            toolStripMenuItem1.ImageScalingSize = new Size(20, 20);
            toolStripMenuItem1.Items.AddRange(new ToolStripItem[] { программаToolStripMenuItem, файлToolStripMenuItem, адресаToolStripMenuItem, добавитьМеткуToolStripMenuItem });
            toolStripMenuItem1.Location = new Point(0, 0);
            toolStripMenuItem1.Name = "toolStripMenuItem1";
            toolStripMenuItem1.Size = new Size(800, 28);
            toolStripMenuItem1.TabIndex = 0;
            toolStripMenuItem1.Text = "menuStrip1";
            // 
            // программаToolStripMenuItem
            // 
            программаToolStripMenuItem.DropDownItems.AddRange(new ToolStripItem[] { toolStripMenuItemPositioningMode, fullsizeToolStripMenuItem, темнаяТемаToolStripMenuItem, exitToolStripMenuItem });
            программаToolStripMenuItem.Name = "программаToolStripMenuItem";
            программаToolStripMenuItem.Size = new Size(105, 24);
            программаToolStripMenuItem.Text = "Программа";
            // 
            // toolStripMenuItemPositioningMode
            // 
            toolStripMenuItemPositioningMode.Name = "toolStripMenuItemPositioningMode";
            toolStripMenuItemPositioningMode.Size = new Size(282, 26);
            toolStripMenuItemPositioningMode.Text = "Режим позиционирования";
            toolStripMenuItemPositioningMode.Click += toolStripMenuItemPositioningMode_Click;
            // 
            // fullsizeToolStripMenuItem
            // 
            fullsizeToolStripMenuItem.Name = "fullsizeToolStripMenuItem";
            fullsizeToolStripMenuItem.Size = new Size(282, 26);
            fullsizeToolStripMenuItem.Text = "Полный экран";
            fullsizeToolStripMenuItem.Click += fullsizeToolStripMenuItem_Click;
            // 
            // темнаяТемаToolStripMenuItem
            // 
            темнаяТемаToolStripMenuItem.Name = "темнаяТемаToolStripMenuItem";
            темнаяТемаToolStripMenuItem.Size = new Size(282, 26);
            темнаяТемаToolStripMenuItem.Text = "Темная тема";
            темнаяТемаToolStripMenuItem.Click += темнаяТемаToolStripMenuItem_Click;
            // 
            // exitToolStripMenuItem
            // 
            exitToolStripMenuItem.Name = "exitToolStripMenuItem";
            exitToolStripMenuItem.Size = new Size(282, 26);
            exitToolStripMenuItem.Text = "Выход";
            exitToolStripMenuItem.Click += exitToolStripMenuItem_Click;
            // 
            // файлToolStripMenuItem
            // 
            файлToolStripMenuItem.DropDownItems.AddRange(new ToolStripItem[] { открытьToolStripMenuItem, сохранитьToolStripMenuItem, сохранитьКакToolStripMenuItem });
            файлToolStripMenuItem.Name = "файлToolStripMenuItem";
            файлToolStripMenuItem.Size = new Size(59, 24);
            файлToolStripMenuItem.Text = "Файл";
            // 
            // открытьToolStripMenuItem
            // 
            открытьToolStripMenuItem.Name = "открытьToolStripMenuItem";
            открытьToolStripMenuItem.Size = new Size(192, 26);
            открытьToolStripMenuItem.Text = "Открыть";
            открытьToolStripMenuItem.Click += открытьToolStripMenuItem_Click;
            // 
            // сохранитьToolStripMenuItem
            // 
            сохранитьToolStripMenuItem.Name = "сохранитьToolStripMenuItem";
            сохранитьToolStripMenuItem.Size = new Size(192, 26);
            сохранитьToolStripMenuItem.Text = "Сохранить";
            // 
            // сохранитьКакToolStripMenuItem
            // 
            сохранитьКакToolStripMenuItem.Name = "сохранитьКакToolStripMenuItem";
            сохранитьКакToolStripMenuItem.Size = new Size(192, 26);
            сохранитьКакToolStripMenuItem.Text = "Сохранить как";
            сохранитьКакToolStripMenuItem.Click += сохранитьКакToolStripMenuItem_Click;
            // 
            // адресаToolStripMenuItem
            // 
            адресаToolStripMenuItem.Name = "адресаToolStripMenuItem";
            адресаToolStripMenuItem.Size = new Size(73, 24);
            адресаToolStripMenuItem.Text = "Адреса";
            адресаToolStripMenuItem.Click += адресаToolStripMenuItem_Click;
            // 
            // добавитьМеткуToolStripMenuItem
            // 
            добавитьМеткуToolStripMenuItem.Name = "добавитьМеткуToolStripMenuItem";
            добавитьМеткуToolStripMenuItem.Size = new Size(143, 24);
            добавитьМеткуToolStripMenuItem.Text = "• Добавить метку";
            добавитьМеткуToolStripMenuItem.Click += добавитьМеткуToolStripMenuItem_Click;
            // 
            // panel1
            // 
            panel1.BackColor = SystemColors.Control;
            panel1.Dock = DockStyle.Fill;
            panel1.Location = new Point(0, 28);
            panel1.Name = "panel1";
            panel1.Size = new Size(800, 422);
            panel1.TabIndex = 1;
            // 
            // MainForm
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(800, 450);
            Controls.Add(panel1);
            Controls.Add(toolStripMenuItem1);
            MainMenuStrip = toolStripMenuItem1;
            Name = "MainForm";
            Text = "Pingerok";
            Load += Form1_Load;
            toolStripMenuItem1.ResumeLayout(false);
            toolStripMenuItem1.PerformLayout();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private MenuStrip toolStripMenuItem1;
        private ToolStripMenuItem программаToolStripMenuItem;
        private ToolStripMenuItem fullsizeToolStripMenuItem;
        private ToolStripMenuItem exitToolStripMenuItem;
        private ToolStripMenuItem адресаToolStripMenuItem;
        private Panel panel1;
        private ToolStripMenuItem toolStripMenuItemPositioningMode;
        private ToolStripMenuItem файлToolStripMenuItem;
        private ToolStripMenuItem открытьToolStripMenuItem;
        private ToolStripMenuItem сохранитьToolStripMenuItem;
        private ToolStripMenuItem сохранитьКакToolStripMenuItem;
        private ToolStripMenuItem добавитьМеткуToolStripMenuItem;
        private ToolStripMenuItem темнаяТемаToolStripMenuItem;
    }
}
