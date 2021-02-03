using JarmuKolcsonzo.Properties;
using JarmuKolcsonzo.Repositories;
using JarmuKolcsonzo.ViewInterfaces;
using JarmuKolcsonzo.ViewModels;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Mail;
using System.Text;
using System.Threading.Tasks;

namespace JarmuKolcsonzo.Presenters
{
    public class RendelesPresenter
    {
        IRendelesView view;
        RendelesRepository repo = new RendelesRepository();
        private UgyfelRepository ugyfelRepo = new UgyfelRepository();
        private JarmuRepository jarmuRepo = new JarmuRepository();

        public RendelesPresenter(IRendelesView param)
        {
            view = param;
        }

        public void Save(rendelesVM rendelesVM)
        {
            view.errorUgyfelNev = null;
            view.errorJarmuRendszam = null;

            bool helyes = true;

            if (string.IsNullOrEmpty(rendelesVM.ugyfelNev))
            {
                view.errorUgyfelNev = Resources.KotelezoMezo;
                helyes = false;

            }
            
            if (string.IsNullOrEmpty(rendelesVM.jarmuRendszam))
            {
                view.errorJarmuRendszam = Resources.KotelezoMezo;
                helyes = false;
            }
            if (helyes)
            {
                if (repo.Exists(rendelesVM)) // Mit felejtek el? rendelesVM.rendelesId miért nem megy?
                {
                    try
                    {

                        repo.Update(rendelesVM);

                    }
                    catch (Exception ex)
                    {

                        view.errorJarmuRendszam = ex.Message;
                    }

                }
                else
                {
                    try
                    {
                        repo.Insert(rendelesVM);

                    }
                    catch (Exception)
                    {

                        view.errorUgyfelNev = Resources.NemJarmu;
                    }


                }
                

            }

            if (ugyfelRepo.GetUgyfelByName(rendelesVM.ugyfelNev) == null)
            {
                view.errorUgyfelNev = Resources.NemUgyfel;
                helyes = false;
            }
            if(helyes)
            {
                if (repo.Exists(rendelesVM))
                {

                    try
                    {
                        repo.Update(rendelesVM);


                    }
                    catch (Exception ex)
                    {

                        view.errorUgyfelNev = ex.Message;

                    }

                }
                else
                {

                    try
                    {
                        repo.Insert(rendelesVM);
                    }
                    catch (Exception )
                    {

                        view.errorUgyfelNev = Resources.NemUgyfel;
                    }


                }

               


            }

            if (jarmuRepo.GetJarmuByLicensePlate(rendelesVM.jarmuRendszam) == null)
            {
                view.errorJarmuRendszam = Resources.NemJarmu;
            }
        }
    }
}
